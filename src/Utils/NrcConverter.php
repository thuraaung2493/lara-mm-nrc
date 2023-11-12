<?php

declare(strict_types=1);

namespace Thuraaung\LaraMmNrc\Utils;

use Illuminate\Support\Collection;
use Thuraaung\ConfigTypes\Facades\Config;
use Thuraaung\LaraMmNrc\ConvertOption;

final class NrcConverter
{
    /** @var Collection<string, string> $source */
    private Collection $source;

    private ConvertOption $option;

    /**
     * Converts the township using the provided option.
     */
    public function township(string $township, ConvertOption $option): string
    {
        $this->source = Config::collect('lara-mm-nrc.townships_codes');
        $this->option = $option;

        return $this->convert($township);
    }

    /**
     * Converts the NRC type using the provided option.
     */
    public function type(string $format, ConvertOption $option): string
    {
        $this->source = Config::collect('lara-mm-nrc.types');
        $this->option = $option;

        return $this->convert($format);
    }

    /**
     * Converts.
     */
    private function convert(string $origin): string
    {
        /** @var array $value */
        $value = $this->source->firstWhere($this->option->from->value, $origin);

        return $value ? $value[$this->option->to->value] : $origin;
    }
}
