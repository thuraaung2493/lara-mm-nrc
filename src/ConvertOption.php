<?php

declare(strict_types=1);

namespace Thuraaung\LaraMmNrc;

final readonly class ConvertOption
{
    public function __construct(
        public Format $from,
        public Format $to,
    ) {
    }

    /**
     * Convert option from english to myanmar.
     */
    public static function enToMm(): self
    {
        return new self(
            from: Format::EN,
            to: Format::MM,
        );
    }

    /**
     * Convert option from myanmar to english.
     */
    public static function mmToEn(): self
    {
        return new self(
            from: Format::MM,
            to: Format::EN,
        );
    }
}
