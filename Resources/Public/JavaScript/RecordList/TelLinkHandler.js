
/**
 * Module: LinkhandlerPlus/RecordList/TelLinkHandler
 * Tel link interaction
 */
define(['jquery', 'TYPO3/CMS/Recordlist/LinkBrowser'], function($, LinkBrowser) {
	'use strict';

	/**
	 *
	 * @type {{}}
	 * @exports LinkhandlerPlus/RecordList/TelLinkHandler
	 */
	var TelLinkHandler = {};

	$(function() {
		$('#ltelform').on('submit', function(event) {
			event.preventDefault();

			var value = $(this).find('[name="ltel"]').val();
			if (value === 'tel:') {
				return;
			}

			while (value.substr(0, 4) === 'tel:') {
				value = value.substr(4);
			}

			LinkBrowser.finalizeFunction('tel:' + value);
		});
	});

	return TelLinkHandler;
});
