<?php

/*
 * This file is part of the Http Helper package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Helper\Normalizer;

use Http\Helper\Message\RequestInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BodyNormalizer
{
    /**
     * Normalizes the body
     *
     * @param callable|resource|string|object $body
     * @param string                          $method
     *
     * @return string|null
     */
    public static function normalize($body, $method)
    {
        // string version is used here instead of constant from interface (dependency avoided)
        if ($method === 'HEAD' || empty($body)) {
            return;
        }

        if (is_callable($body)) {
            return call_user_func($body);
        }

        return $body;
    }
}
