<?php

/*
 * This file is part of the Http Adapter package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Adapter\Tests\Extractor;

use Http\Adapter\Extractor\ProtocolVersionExtractor;
use Http\Adapter\Tests\Parser\AbstractHeadersParserTest;

/**
 * Protocol version extractor test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class ProtocolVersionExtractorTest extends AbstractHeadersParserTest
{
    /**
     * @dataProvider headersProvider
     */
    public function testExtract($headers)
    {
        $this->assertSame('1.1', ProtocolVersionExtractor::extract($headers));
    }
}
