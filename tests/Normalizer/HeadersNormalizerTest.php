<?php

/*
 * This file is part of the Http Adapter package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Http\Adapter\Tests\Normalizer;

use Http\Adapter\Normalizer\HeadersNormalizer;

/**
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class HeadersNormalizerTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalizeAsAssociativeWithStringHeaders()
    {
        $this->assertSame(
            ['fOo' => 'bar, bot', 'Baz' => 'bat, ban', 'Date' => 'Fri, 15 aug 2014 12:34:56 UTC'],
            HeadersNormalizer::normalize($this->getStringHeaders())
        );
    }

    public function testNormalizeAsNotAssociativeWithStringHeaders()
    {
        $this->assertSame(
            ['fOo: bar, bot', 'Baz: bat, ban', 'Date: Fri, 15 aug 2014 12:34:56 UTC'],
            HeadersNormalizer::normalize($this->getStringHeaders(), false)
        );
    }

    public function testNormalizeAsAssociativeWithSubAssociativeArrayHeaders()
    {
        $this->assertSame(
            ['fOo' => 'bar, bot', 'Baz' => 'bat, ban', 'Date' => 'Fri, 15 aug 2014 12:34:56 UTC'],
            HeadersNormalizer::normalize($this->getSubAssociativeHeaders())
        );
    }

    public function testNormalizeAsAssociativeWithAssociativeArrayHeaders()
    {
        $this->assertSame(
            ['fOo' => 'bar, bot', 'Baz' => 'bat, ban', 'Date' => 'Fri, 15 aug 2014 12:34:56 UTC'],
            HeadersNormalizer::normalize($this->getAssociativeHeaders())
        );
    }

    public function testNormalizeAsNotAssociativeWithIndexedArrayHeaders()
    {
        $this->assertSame(
            ['fOo: bar, bot', 'Baz: bat, ban', 'Date: Fri, 15 aug 2014 12:34:56 UTC'],
            HeadersNormalizer::normalize($this->getIndexedHeaders(), false)
        );
    }

    public function testNormalizeHeaderName()
    {
        $this->assertSame('FoO', HeadersNormalizer::normalizeHeaderName(' FoO '));
    }

    public function testNormalizeHeaderValueWithString()
    {
        $this->assertSame('foo, bar', HeadersNormalizer::normalizeHeaderValue(' foo , bar '));
    }

    public function testNormalizeHeaderValueWithArray()
    {
        $this->assertSame('foo, bar', HeadersNormalizer::normalizeHeaderValue([' foo ', ' bar ']));
    }

    /**
     * Returns the string headers
     *
     * @return string
     */
    private function getStringHeaders()
    {
        return implode("\r\n", $this->getIndexedHeaders());
    }

    /**
     * Returns the indexed headers
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
     * Returns the associative headers
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
     * Returns the sub associative headers
     *
     * @return array
     */
    private function getSubAssociativeHeaders()
    {
        return [
            'HTTP/1.1 200 OK',
            ' fOo '  => [' bar '],
            'fOo'    => [' bot '],
            ' Baz '  => [' bat ', ' ban '],
            ' Date ' => [' Fri, 15 aug 2014 12:34:56 UTC '],
        ];
    }
}
