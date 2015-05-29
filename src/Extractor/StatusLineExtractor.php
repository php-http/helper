<?php

/*
 * This file is part of the Http Helper package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Helper\Extractor;

use Http\Helper\Parser\HeaderParser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusLineExtractor
{
    /**
     * Extracts the status line
     *
     * @param string|string[] $headers
     *
     * @return string
     */
    public static function extract($headers)
    {
        $headers = HeaderParser::parse($headers);

        return $headers[0];
    }
}
