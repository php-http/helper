<?php

/*
 * This file is part of the Http Helper package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Helper\Tests\Parser;

use Http\Helper\Parser\HeaderParser;
use Http\Helper\Tests\HeaderProvider;

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
