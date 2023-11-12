<?php

declare(strict_types=1);

use Thuraaung\LaraMmNrc\Format;

test('Type Enum Class', function (): void {
    expect(Format::EN->value)
        ->toBe('en');

    expect(Format::MM->value)
        ->toBe('mm');

    expect(Format::MM->isMM())
        ->toBeTrue();

    expect(Format::EN->isEN())
        ->toBeTrue();
});
