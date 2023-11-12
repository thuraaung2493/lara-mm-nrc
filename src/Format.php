<?php

declare(strict_types=1);

namespace Thuraaung\LaraMmNrc;

enum Format: string
{
    case MM = 'mm';
    case EN = 'en';

    /**
     * Is the format in English.
     */
    public function isEN(): bool
    {
        return Format::EN === $this;
    }

    /**
     * Is the format in Myanmar.
     */
    public function isMM(): bool
    {
        return Format::MM === $this;
    }
}
