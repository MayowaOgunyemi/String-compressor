<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Vendor\Seven20StringCompressor\StringCompressor;
use InvalidArgumentException;

class StringCompressorTest extends TestCase
{
    private StringCompressor $compressor;

    protected function setUp(): void
    {
        $this->compressor = new StringCompressor();
    }

    public function testCompressSimpleString()
    {
        $input = "aabbcc";
        $expected = "a2b2c2";

        $this->assertEquals($expected, $this->compressor->compress($input));
    }

    public function testCompressMixedCharacters()
    {
        $input = "aaabbccdd";
        $expected = "a3b2c2d2";

        $this->assertEquals($expected, $this->compressor->compress($input));
    }

    public function testCompressWithCaseSensitivity()
    {
        $input = "aAaaAA";
        $expected = "a3A3";

        $this->assertEquals($expected, $this->compressor->compress($input));
    }

    public function testCompressWithNonAlphabeticCharacters()
    {
        $input = "1122!!@@";
        $expected = "1222!2@2";

        $this->assertEquals($expected, $this->compressor->compress($input));
    }

    public function testCompressThrowsExceptionOnEmptyString()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->compressor->compress("");
    }

    public function testCompressThrowsExceptionOnWhitespaceOnlyString()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->compressor->compress("     ");
    }

    public function testCompressSingleCharacter()
    {
        $input = "z";
        $expected = "z1";

        $this->assertEquals($expected, $this->compressor->compress($input));
    }

    public function testCompressLongString()
    {
        $input = str_repeat("x", 1000) . str_repeat("y", 500);
        $expected = "x1000y500";

        $this->assertEquals($expected, $this->compressor->compress($input));
    }
}
