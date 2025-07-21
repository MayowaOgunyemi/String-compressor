<?php

require 'vendor/autoload.php';

use Vendor\Seven20StringCompressor\StringCompressor;

// $compressor = new StringCompressor();

// $input = "aabbccaa";
// echo "Original: $input\n";
// echo "Compressed: " . $compressor->compress($input) . "\n";
try {
    $compressor = new StringCompressor();
    $input = "aaabbccddddddefghhhiiiiihhhxxxxaaaaffffjjjjeeeeeeeeeeeeeeeeePPPPPPaaaaAAAA";

    echo "Original:   $input\n";
    echo "Compressed: " . $compressor->compress($input) . "\n";
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}
