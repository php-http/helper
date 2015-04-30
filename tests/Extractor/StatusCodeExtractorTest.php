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

use Http\Adapter\Extractor\StatusCodeExtractor;
use Http\Adapter\Tests\HeaderProvider;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusCodeExtractorTest extends HeaderProvider
{
    /**
     * @dataProvider headerProvider
     */
    public function testExtract($headers)
    {
        $this->assertSame(200, StatusCodeExtractor::extract($headers));
    }
}
