<?php
namespace Monosize\LinkHandler\Plus\Recordlist\LinkHandler;


use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Recordlist\Controller\AbstractLinkBrowserController;
use TYPO3\CMS\Recordlist\LinkHandler\AbstractLinkHandler;
use TYPO3\CMS\Recordlist\LinkHandler\LinkHandlerInterface;

/**
 * Link handler for email links
 */
class TelLinkHandler extends AbstractLinkHandler implements LinkHandlerInterface
{
    /**
     * Parts of the current link
     *
     * @var array
     */
    protected $linkParts = [];

    /**
     * We don't support updates since there is no difference to simply set the link again.
     *
     * @var bool
     */
    protected $updateSupported = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        // remove unsupported link attributes
        foreach (['target', 'rel'] as $attribute) {
            $position = array_search($attribute, $this->linkAttributes, true);
            if ($position !== false) {
                unset($this->linkAttributes[$position]);
            }
        }
    }

    /**
     * Initialize the handler
     *
     * @param AbstractLinkBrowserController $linkBrowser
     * @param string $identifier
     * @param array $configuration Page TSconfig
     *
     * @return void
     * @throws \InvalidArgumentException
     */
    public function initialize(AbstractLinkBrowserController $linkBrowser, $identifier, array $configuration)
    {
        parent::initialize($linkBrowser, $identifier, $configuration);
        $this->view->setTemplateRootPaths([
            GeneralUtility::getFileAbsFileName('EXT:recordlist/Resources/Private/Templates/LinkBrowser'),
            GeneralUtility::getFileAbsFileName('EXT:linkhandler_plus/Resources/Private/Templates/LinkBrowser')
        ]);

        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $fullJsPath = PathUtility::getRelativePath(
            PATH_typo3,
            GeneralUtility::getFileAbsFileName('EXT:linkhandler_plus/Resources/Public/JavaScript/')
        );

        // requirejs
        $pageRenderer->addRequireJsConfiguration([
            'paths' => [
                'LinkhandlerPlus/RecordList/TelLinkHandler' => $fullJsPath . 'RecordList/TelLinkHandler',
            ],
        ]);

    }

    /**
     * Checks if this is the handler for the given link
     *
     * The handler may store this information locally for later usage.
     *
     * @param array $linkParts Link parts as returned from TypoLinkCodecService
     *
     * @return bool
     */
    public function canHandleLink(array $linkParts)
    {
        if ($linkParts['type'] === 'tel' && isset($linkParts['url']['url'])) {
            $this->linkParts = $linkParts;

            return true;
        }

        return false;
    }

    /**
     * Format the current link for HTML output
     *
     * @return string
     */
    public function formatCurrentUrl()
    {
        return $this->linkParts['url']['url'];
    }

    /**
     * Render the link handler
     *
     * @param ServerRequestInterface $request
     *
     * @return string
     */
    public function render(ServerRequestInterface $request)
    {
        GeneralUtility::makeInstance(PageRenderer::class)->loadRequireJsModule('TYPO3/CMS/LinkhandlerPlus/RecordList/TelLinkHandler');

        $this->view->assign('tel', !empty($this->linkParts) ? $this->linkParts['url']['url'] : '');

        return $this->view->render('Tel');
    }

    /**
     * @return string[] Array of body-tag attributes
     */
    public function getBodyTagAttributes()
    {
        return [];
    }
}
