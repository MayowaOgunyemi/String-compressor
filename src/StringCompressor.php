<?php

namespace Vendor\Seven20StringCompressor;

use InvalidArgumentException;


/**
 * Class StringCompressor
 *
 * Compresses a string by aggregating counts of all character occurrences (non-consecutive).
 * E.g., "aaabbcc" => "a3b2c2"
 */
class StringCompressor
{
        
    /**
     * Compress the given input string into char+count format.
     *
     * @param string $input
     * @return string
     * @throws InvalidArgumentException
     */
    public function compress(string $input): string
    {
        $this->validate($input);

        [$charCounts, $orderedChars] = $this->countCharacters($input);

        return $this->buildCompressedString($charCounts, $orderedChars);
    }

    /**
     * Validates the input string for correctness.
     *
     * @param string $input
     * @return void
     * @throws InvalidArgumentException
     */
    private function validate(string $input): void
    {
        if (trim($input) === '') {
            throw new InvalidArgumentException("Input string must not be empty or whitespace.");
        }
    }

    /**
     * Count characters and maintain their first-seen order.
     *
     * @param string $input
     * @return array{array<string, int>, string[]}
     */
    private function countCharacters(string $input): array
    {
        $charCounts = [];
        $orderedChars = [];
        $len = strlen($input);

        for ($i = 0; $i < $len; $i++) {
            $char = $input[$i];

            if (!isset($charCounts[$char])) {
                $charCounts[$char] = 1;
                $orderedChars[] = $char;
            } else {
                $charCounts[$char]++;
            }
        }

        return [$charCounts, $orderedChars];
    }

    /**
     * Generate the final compressed string from the map and order list.
     *
     * @param array<string, int> $charCounts
     * @param string[] $orderedChars
     * @return string
     */
    private function buildCompressedString(array $charCounts, array $orderedChars): string
    {
        $compressedParts = [];

        foreach ($orderedChars as $char) {
            $compressedParts[] = $char . $charCounts[$char];
        }

        return implode('', $compressedParts);
    }
}
