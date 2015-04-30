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

use Http\Adapter\Normalizer\BodyNormalizer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BodyNormalizerTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalizeWithResource()
    {
        $body = fopen('php://temp', 'r');

        $this->assertSame($body, BodyNormalizer::normalize($body, 'GET'));
    }

    public function testNormalizeWithString()
    {
        $body = 'foo';

        $this->assertSame($body, BodyNormalizer::normalize($body, 'GET'));
    }

    public function testNormalizeWithObject()
    {
        $body = $this->getMock('stdClass');

        $this->assertSame($body, BodyNormalizer::normalize($body, 'GET'));
    }

    public function testNormalizeWithCallable()
    {
        $result = 'foo';
        $body = function () use ($result) {
            return $result;
        };

        $this->assertSame($result, BodyNormalizer::normalize($body, 'GET'));
    }

    public function testNormalizeWithHeadMethod()
    {
        $this->assertNull(BodyNormalizer::normalize('foo', 'HEAD'));
    }

    public function testNormalizeWithEmptyString()
    {
        $this->assertNull(BodyNormalizer::normalize('', 'GET'));
    }

    public function testNormalizeWithFalseBoolean()
    {
        $this->assertNull(BodyNormalizer::normalize(false, 'GET'));
    }
}
