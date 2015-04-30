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

use Http\Adapter\Parser\HeaderParser;
use Http\Adapter\Tests\HeaderProvider;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeaderParserTest extends HeaderProvider
{
    /**
     * @dataProvider headerProvider
     */
    public function testParse($headers)
    {
        $this->assertSame(
            [
                'HTTP/1.1 200 OK',
                'foo: bar',
                'baz: bat, ban',
            ],
            HeaderParser::parse($headers)
        );
    }
}
