<?php

/*
 * This file is part of the Http Helper package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Helper\Tests\Extractor;

use Http\Helper\Extractor\StatusLineExtractor;
use Http\Helper\Tests\HeaderProvider;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusLineExtractorTest extends HeaderProvider
{
    /**
     * @dataProvider headerProvider
     */
    public function testExtract($headers)
    {
        $this->assertSame('HTTP/1.1 200 OK', StatusLineExtractor::extract($headers));
    }
}
