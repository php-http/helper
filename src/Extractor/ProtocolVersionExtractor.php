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

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class ProtocolVersionExtractor
{
    /**
     * Extracts the protocol version
     *
     * @param string|string[] $headers
     *
     * @return string
     */
    public static function extract($headers)
    {
        return substr(StatusLineExtractor::extract($headers), 5, 3);
    }
}
