<?php

declare(strict_types=1);

namespace Thuraaung\LaraMmNrc\Contracts;

use Thuraaung\LaraMmNrc\Nrc;
use Thuraaung\LaraMmNrc\Format;

interface LaraMmNrcInterface
{
    public static function of(string $nrc): self;
    public static function from(string $nrc): self;
    public function toInstance(Format $format): ?Nrc;
    public function toEn(): Nrc;
    public function toMm(): Nrc;
    public function isValid(): bool;
    public function isInvalid(): bool;
    public function isMm(): bool;
    public function isEn(): bool;
}
