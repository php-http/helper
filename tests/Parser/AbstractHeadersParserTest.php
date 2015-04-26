<?php

/*
 * This file is part of the Http Adapter package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Adapter\Tests\Parser;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractHeadersParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides data to the parser
     *
     * @return array
     */
    public function headersProvider()
    {
        return array_merge($this->simpleHeadersProvider(), $this->redirectHeadersProvider());
    }

    /**
     * Provides simple data
     *
     * @return array
     */
    public function simpleHeadersProvider()
    {
        return [
            [$this->getStringHeaders()],
            [$this->getIndexedHeaders()],
            [$this->getAssociativeHeaders()],
            [$this->getSubAssociativeHeaders()],
        ];
    }

    /**
     * Provides redirect data
     *
     * @return array
     */
    public function redirectHeadersProvider()
    {
        return [
            [$this->getRedirectStringHeaders()],
            [$this->getRedirectIndexedHeaders()],
            [$this->getRedirectAssociativeHeaders()],
            [$this->getRedirectSubAssociativeHeaders()],
        ];
    }

    /**
     * Returns string headers
     *
     * @return string
     */
    private function getStringHeaders()
    {
        return implode("\r\n", $this->getIndexedHeaders());
    }

    /**
     * Returns indexed headers
     *
     * @return array
     */
    private function getIndexedHeaders()
    {
        $headers = [];

        foreach ($this->getAssociativeHeaders() as $name => $value) {
            $headers[] = is_int($name) ? $value : $name.': '.$value;
        }

        return $headers;
    }

    /**
     * Returns associative headers
     *
     * @return array
     */
    private function getAssociativeHeaders()
    {
        $headers = [];

        foreach ($this->getSubAssociativeHeaders() as $name => $value) {
            if (is_int($name)) {
                $headers[] = $value;
            } else {
                $headers[$name] = implode(', ', $value);
            }
        }

        return $headers;
    }

    /**
     * Returns sub associative headers
     *
     * @return array
     */
    private function getSubAssociativeHeaders()
    {
        return [
            'HTTP/1.1 200 OK',
            'foo' => ['bar'],
            'baz' => ['bat', 'ban'],
        ];
    }

    /**
     * Returns redirect string headers
     *
     * @return string
     */
    private function getRedirectStringHeaders()
    {
        return implode("\r\n", $this->getRedirectIndexedHeaders());
    }

    /**
     * Returns redirect indexed headers
     *
     * @return array
     */
    private function getRedirectIndexedHeaders()
    {
        $headers = [];

        foreach ($this->getRedirectAssociativeHeaders() as $name => $value) {
            $headers[] = is_int($name) ? $value : $name.': '.$value;
        }

        return $headers;
    }

    /**
     * Returns redirect associative headers
     *
     * @return array
     */
    private function getRedirectAssociativeHeaders()
    {
        $headers = [];

        foreach ($this->getRedirectSubAssociativeHeaders() as $name => $value) {
            if (is_int($name)) {
                $headers[] = $value;
            } else {
                $headers[$name] = implode(', ', $value);
            }
        }

        return $headers;
    }

    /**
     * Returns redirect sub associative headers
     *
     * @return array
     */
    private function getRedirectSubAssociativeHeaders()
    {
        return array_merge(
            [
                'HTTP/1.0 302 Temporary moved',
                'bin'      => ['bot'],
                'location' => [$this->getRedirectLocation()],
                '',
            ],
            $this->getSubAssociativeHeaders()
        );
    }

    /**
     * Returns the redirect location
     *
     * @return string
     */
    private function getRedirectLocation()
    {
        return 'http://php-http.org/';
    }
}
