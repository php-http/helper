<?php

/*
 * This file is part of the Http Adapter package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Adapter\Extractor;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusCodeExtractor
{
    /**
     * Extracts the status code
     *
     * @param string|string[] $headers
     *
     * @return integer
     */
    public static function extract($headers)
    {
        return (int) substr(StatusLineExtractor::extract($headers), 9, 3);
    }
}
