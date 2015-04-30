<?php

/*
 * This file is part of the Http Adapter package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Adapter\Parser;

use Http\Adapter\Normalizer\HeadersNormalizer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeadersParser
{
    /**
     * Parses the headers
     *
     * @param string|string[] $headers
     *
     * @return string[]
     */
    public static function parse($headers)
    {
        if (is_string($headers)) {
            $headers = explode("\r\n\r\n", trim($headers));

            return explode("\r\n", end($headers));
        }

        $parsedHeaders = [];

        foreach ($headers as $name => $value) {
            $value = HeadersNormalizer::normalizeHeaderValue($value);

            if (is_int($name)) {
                if (strpos($value, 'HTTP/') === 0) {
                    $parsedHeaders = [$value];
                } else {
                    $parsedHeaders[] = $value;
                }
            } else {
                $parsedHeaders[] = $name.': '.$value;
            }
        }

        return $parsedHeaders;
    }
}
