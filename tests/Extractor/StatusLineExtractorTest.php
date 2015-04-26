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

use Http\Adapter\Extractor\StatusLineExtractor;
use Http\Adapter\Tests\Parser\AbstractHeadersParserTest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusLineExtractorTest extends AbstractHeadersParserTest
{
    /**
     * @dataProvider headersProvider
     */
    public function testExtract($headers)
    {
        $this->assertSame('HTTP/1.1 200 OK', StatusLineExtractor::extract($headers));
    }
}
