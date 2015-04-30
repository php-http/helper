<?php

/*
 * This file is part of the Http Adapter package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Adapter\Normalizer;

use Http\Adapter\Parser\HeaderParser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeaderNormalizer
{
    /**
     * Normalizes the headers
     *
     * @param string|string[] $headers
     * @param boolean         $associative TRUE if the headers should be an associative array else FALSE.
     *
     * @return string[]
     */
    public static function normalize($headers, $associative = true)
    {
        $normalizedHeaders = [];

        if (!$associative) {
            $headers = self::normalize($headers);
        }

        foreach (HeaderParser::parse($headers) as $name => $value) {
            if (strpos($value, 'HTTP/') === 0) {
                continue;
            }

            list($name, $value) = explode(':', $value, 2);

            $name = self::normalizeHeaderName($name);
            $value = self::normalizeHeaderValue($value);

            if (!$associative) {
                $normalizedHeaders[] = $name.': '.$value;
            } else {
                $normalizedHeaders[$name] = isset($normalizedHeaders[$name])
                    ? $normalizedHeaders[$name].', '.$value
                    : $value;
            }
        }

        return $normalizedHeaders;
    }

    /**
     * Normalizes the header name
     *
     * @param string $name
     *
     * @return string
     */
    public static function normalizeHeaderName($name)
    {
        return trim($name);
    }

    /**
     * Normalizes the header value
     *
     * @param array|string $value
     *
     * @return string
     */
    public static function normalizeHeaderValue($value)
    {
        return implode(', ', array_map('trim', is_array($value) ? $value : explode(',', $value)));
    }
}
