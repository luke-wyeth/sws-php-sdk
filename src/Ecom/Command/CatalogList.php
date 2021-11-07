<?php

declare(strict_types=1);

namespace Serato\SwsSdk\License\Command;

use Serato\SwsSdk\CommandBasicAuth;

/**
 * Gets a filtered list of catalog products from the SWS Ecom service.
 *
 * Valid keys for the `$args` array provided to the constructor are:
 *
 * - `app_name`: (string) Only return products compatible with the host application.
 * - `app_version`: (string) Only return products compatible with the host application version.
 *
 * This command can be excuted on a `Serato\SwsSdk\License\EcomClient` instance
 * using the `EcomClient::getCatalog` magic method.
 */
class CatalogList extends CommandBasicAuth
{
    /**
     * {@inheritdoc}
     */
    public function getBody(): string
    {
        $args = $this->commandArgs;
        return $this->arrayToFormUrlEncodedBody($args);
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpMethod(): string
    {
        return 'GET';
    }

    /**
     * {@inheritdoc}
     */
    public function getUriPath(): string
    {
        return
        '/api/v1/catalog/products';
    }

    /**
     * {@inheritdoc}
     */
    public function getUriQuery(): string
    {
        return http_build_query($this->commandArgs);
    }

    /**
     * {@inheritdoc}
     */
    protected function getArgsDefinition(): array
    {
        return [
            'app_name'      => ['type' => self::ARG_TYPE_STRING, 'required' => false],
            'app_version'   => ['type' => self::ARG_TYPE_STRING, 'required' => false]
        ];
    }
}
