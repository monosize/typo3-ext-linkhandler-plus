<?php
namespace Monosize\LinkHandler\Plus\LinkHandling;

use TYPO3\CMS\Core\LinkHandling\LinkHandlingInterface;

class TelLinkHandler implements LinkHandlingInterface
{

    /**
     * Returns the link to an tel as a string
     *
     * @param array $parameters
     * @return string
     */
    public function asString(array $parameters): string
    {
        return 'tel:' . $parameters['tel'];
    }

    /**
     * Returns the email address without the "tel:" prefix
     * in the 'tel' property of the array.
     *
     * @param array $data
     * @return array
     */
    public function resolveHandlerData(array $data): array
    {
        return ['tel' => substr($data['tel'], 4)];
    }}
