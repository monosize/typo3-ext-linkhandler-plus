TCEMAIN.linkHandler {
    tel {
        handler = Monosize\LinkHandler\Plus\Recordlist\LinkHandler\TelLinkHandler
        label = LLL:EXT:linkhandler_plus/Resources/Private/Language/locallang_browse_links.xlf:tel
        scanAfter = page
        addParams = onclick="jumpToUrl('?act=tel&linkAttributes[title]=Call number&linkAttributes[class]=phone&linkAttributes[params]=');return false;"
    }
}