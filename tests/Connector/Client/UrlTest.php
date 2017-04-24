<?php

namespace Tests\Sylake\Sylakim\Connector\Client;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Sylake\Sylakim\Connector\Client\Url;

final class UrlTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider provideValidUrls
     */
    public function it_represents_a_valid_url($url)
    {
        Assert::assertInstanceOf(Url::class, Url::fromString($url));
    }

    /**
     * @test
     *
     * @dataProvider provideValidUrls
     */
    public function it_can_be_represented_as_string($url)
    {
        Assert::assertSame($url, (string) Url::fromString($url));
    }

    /**
     * @test
     *
     * @expectedException \InvalidArgumentException
     *
     * @dataProvider provideInvalidUrls
     */
    public function it_filters_out_invalid_urls($notAnUrl)
    {
        Url::fromString($notAnUrl);
    }

    /**
     * @return array
     */
    public function provideValidUrls()
    {
        return [
            ['http://sylius.org'],
            ['https://sylius.org'],
            ['http://sylius.org/'],
            ['http://sylius.org/favicon.ico'],
            ['http://sylius.org/products'],
            ['http://sylius.org/products?foo=bar'],
            ['http://sylius.org/products?foo=bar&bar=baz'],
            ['http://sylius.org/#element'],
        ];
    }

    /**
     * @return array
     */
    public function provideInvalidUrls()
    {
        return [
            ['not an url'],
            ['http://not an.url'],
        ];
    }
}
