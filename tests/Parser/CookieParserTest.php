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

use Http\Adapter\Parser\CookieParser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class CookieParserTest extends AbstractCookieParserTest
{
    /**
     * @dataProvider parseProvider
     */
    public function testParse($header, $name, $value, array $attributes = [])
    {
        $this->assertSame([$name, $value, $attributes], CookieParser::parse($header));
    }
}
