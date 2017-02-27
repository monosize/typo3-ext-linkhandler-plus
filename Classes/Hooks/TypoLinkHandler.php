<?php

namespace Monosize\LinkHandler\Plus\Hooks;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Service\TypoLinkCodecService;

class TypoLinkHandler implements SingletonInterface
{
    /**
     * @return array
     *
     * @param string $linkText
     * @param array $configuration
     * @param string $linkHandlerKeyword
     * @param string $linkHandlerValue
     * @param string $mixedLinkParameter
     * @param $cObj ContentObjectRenderer
     */
    public function main($linkText, $configuration, $linkHandlerKeyword, $linkHandlerValue, $mixedLinkParameter, $cObj)
    {

        $linkParameterParts = GeneralUtility::makeInstance(TypoLinkCodecService::class)->decode($mixedLinkParameter);

        return [
            'href'   => 'unknown:' . $linkHandlerKeyword . ':' . $linkHandlerValue,
            'target' => $linkParameterParts['target'],
            'class'  => $linkParameterParts['class'],
            'title'  => $linkParameterParts['title']
        ];
    }

}
