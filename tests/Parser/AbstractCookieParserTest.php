<?php

/*
 * This file is part of the Http Adapter package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Adapter\Tests\Parser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractCookieParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides data to the parser
     *
     * @return array
     */
    public function parseProvider()
    {
        return [
            ['', null, null],
            [' ', null, null],
            ['=', null, null],
            [' = ', null, null],
            [';', null, null],
            [' ; ', null, null],
            ['=;', null, null],
            [' = ; ', null, null],
            ['foo=', 'foo', null],
            [' foo = ', 'foo', null],
            ['foo=bar', 'foo', 'bar'],
            [' foo = bar ', 'foo', 'bar'],
            ['foo=bar;domain=php-http.org', 'foo', 'bar', ['domain' => 'php-http.org']],
            [
                ' foo = bar ; domain = php-http.org ',
                'foo',
                'bar',
                ['domain' => 'php-http.org'],
            ],
            ['foo=bar;path=/path', 'foo', 'bar', ['path' => '/path']],
            [' foo = bar ; path = /path ', 'foo', 'bar', ['path' => '/path']],
            ['foo=bar;secure', 'foo', 'bar', ['secure' => true]],
            [' foo = bar ; secure ', 'foo', 'bar', ['secure' => true]],
            [
                'foo=bar;expires=Fri, 15 aug 2014 12:34:56 UTC',
                'foo',
                'bar',
                ['expires' => 'Fri, 15 aug 2014 12:34:56 UTC'],
            ],
            [
                ' foo = bar ; expires = Fri, 15 aug 2014 12:34:56 UTC ',
                'foo',
                'bar',
                ['expires' => 'Fri, 15 aug 2014 12:34:56 UTC'],
            ],
            ['foo=bar;max-age=123', 'foo', 'bar', ['max-age' => '123']],
            [' foo = bar ; max-age = 123', 'foo', 'bar', ['max-age' => '123']],
            [
                'foo=bar;domain=php-http.org;path=/path;secure;expires=Fri, 15 aug 2014 12:34:56 UTC;max-age=123',
                'foo',
                'bar',
                [
                    'domain'  => 'php-http.org',
                    'path'    => '/path',
                    'secure'  => true,
                    'expires' => 'Fri, 15 aug 2014 12:34:56 UTC',
                    'max-age' => '123',
                ],
            ],
            [
                ' foo = bar ; domain = php-http.org ; path = /path ; secure ;'.
                ' expires = Fri, 15 aug 2014 12:34:56 UTC ; max-age = 123',
                'foo',
                'bar',
                [
                    'domain'  => 'php-http.org',
                    'path'    => '/path',
                    'secure'  => true,
                    'expires' => 'Fri, 15 aug 2014 12:34:56 UTC',
                    'max-age' => '123',
                ],
            ],
        ];
    }
}
