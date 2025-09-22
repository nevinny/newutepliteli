<?php

namespace App\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FormatProductSizesExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('format_product_sizes', [$this, 'formatTable']),
        ];
    }

    public function formatTable(string $text): array
    {
        $lines = explode("\n", trim($text));
        $result = [];

        foreach ($lines as $index => $line) {
            $line = trim($line);
            if (empty($line)) continue;

            $columns = array_map('trim', explode("\t", $line));

            if ($index === 0) {
                $result['headers'] = $columns;
            } else {
                $result['rows'][] = $columns;
            }
        }

        return $result;
    }

}
