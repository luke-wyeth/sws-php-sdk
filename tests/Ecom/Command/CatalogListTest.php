<?php

declare(strict_types=1);

namespace Serato\SwsSdk\Test\License\Command;

use Serato\SwsSdk\Test\AbstractTestCase;
use Serato\SwsSdk\Ecom\Command\CatalogList;

class CatalogListTest extends AbstractTestCase
{
    public function testSmokeTest(): void
    {
        $command = new CatalogList(
            'app_id',
            'app_password',
            'http://my.server.com'
        );

        $request = $command->getRequest();
        parse_str((string)$request->getUri()->getQuery(), $queryParams);
        $this->assertEquals('GET', $request->getMethod());
        $this->assertRegExp('/^\/api\/v1\/catalog\/products$/', $request->getUri()->getPath());
        $this->assertRegExp('/^Basic [[:alnum:]=]+$/', $request->getHeaderLine('Authorization'));
    }
}
