<?php

declare(strict_types=1);

namespace Thuraaung\LaraMmNrc\Utils;

use Thuraaung\ConfigTypes\Facades\Config;
use Thuraaung\LaraMmNrc\ConvertOption;
use Thuraaung\LaraMmNrc\Format;

final class NumberConverter
{
    public static function convert(string $numbers, ConvertOption $option): string
    {
        $source = Config::collect('lara-mm-nrc.numbers');

        return collect(mb_str_split($numbers))
            ->map(fn ($n) => match ($option->from) {
                Format::MM => $source->get($n, $n),
                Format::EN => $source->flip()->get($n, $n),
            })->join('');
    }
}
