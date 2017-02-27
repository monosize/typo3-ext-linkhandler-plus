<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['linkHandler']['tel'] = Monosize\LinkHandler\Plus\LinkHandling\TelLinkHandler::class;

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:linkhandler_plus/Configuration/TSconfig/Page/LinkHandler.ts">'
);
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_content.php']['typolinkLinkHandler']['tel'] = Monosize\LinkHandler\Plus\Hooks\TypoLinkHandler::class;
