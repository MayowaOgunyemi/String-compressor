<?php

require 'vendor/autoload.php';

use Vendor\Seven20StringCompressor\StringCompressor;

try {
    $compressor = new StringCompressor();
    $input = "aaabbccddddddefghhhiiiiihhhxxxxaaaaffffjjjjeeeeeeeeeeeeeeeeePPPPPPaaaaAAAA";

    echo "Original:   $input\n";
    echo "Compressed: " . $compressor->compress($input) . "\n";
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}
