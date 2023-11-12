<?php

declare(strict_types=1);

use Thuraaung\LaraMmNrc\ConvertOption;
use Thuraaung\LaraMmNrc\Format;

it('can create ConvertOption object', function (): void {
    expect(new ConvertOption(Format::EN, Format::MM))
        ->toBeInstanceOf(ConvertOption::class)
        ->from->toEqual(Format::EN)
        ->to->toEqual(Format::MM);

    expect(ConvertOption::enToMm())
        ->toBeInstanceOf(ConvertOption::class)
        ->from->toEqual(Format::EN)
        ->to->toEqual(Format::MM);

    expect(ConvertOption::mmToEn())
        ->toBeInstanceOf(ConvertOption::class)
        ->from->toEqual(Format::MM)
        ->to->toEqual(Format::EN);
});
