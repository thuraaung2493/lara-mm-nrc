<?php

declare(strict_types=1);

use Thuraaung\LaraMmNrc\LaraMmNrc;
use Thuraaung\LaraMmNrc\Format;
use Thuraaung\LaraMmNrc\Nrc;

test('Myanmar NRC to English NRC', function (string $mmNrc, string $enNrc): void {
    $result = LaraMmNrc::from($mmNrc)->toEn();

    expect($result->toString())->toBe($enNrc);
    expect($result)->toBeInstanceOf(Nrc::class)
        ->toHaveMethods([
            'getOrigin',
            'getStateNo',
            'getType',
            'getTownshipCode',
            'getNumbers'
        ]);
})->with('mm-en');

test('English NRC to Myanmar NRC', function (string $enNrc, string $mmNrc): void {
    $result = LaraMmNrc::from($enNrc)->toMm();

    expect($result->toString())->toBe($mmNrc);
    expect($result)->toBeInstanceOf(Nrc::class)
        ->toHaveMethods([
            'getOrigin',
            'getStateNo',
            'getType',
            'getTownshipCode',
            'getNumbers'
        ]);
})->with('en-mm');

it('can verify whether the Myanmar NRC format is valid', function (string $mmNrc): void {
    expect(LaraMmNrc::of($mmNrc)->isValid())
        ->toBeTrue();
})->with('mm-nrcs');

it('can verify whether the English NRC format is valid', function (string $enNrc): void {
    expect(LaraMmNrc::of($enNrc)->isValid())
        ->toBeTrue();
})->with('en-nrcs');

it('can verify whether the Myanmar NRC format is invalid', function (string $mmNrc): void {
    expect(LaraMmNrc::of($mmNrc)->isInvalid())
        ->toBeTrue();
})->with('invalid-mm-nrc');

it('can verify whether the English NRC format is invalid', function (string $enNrc): void {
    expect(LaraMmNrc::of($enNrc)->isInvalid())
        ->toBeTrue();
})->with('invalid-en-nrc');

it('can verify whether the NRC is Myanmar', function (string $mmNrc): void {
    expect(LaraMmNrc::of($mmNrc)->isMm())
        ->toBeTrue();
    expect(LaraMmNrc::of($mmNrc)->isEn())
        ->toBeFalse();
})->with('mm-nrcs');

it('can verify whether the NRC is English', function (string $enNrc): void {
    expect(LaraMmNrc::of($enNrc)->isEn())
        ->toBeTrue();
    expect(LaraMmNrc::of($enNrc)->isMm())
        ->toBeFalse();
})->with('en-nrcs');

it('should create NRC object from string', function (): void {
    expect(LaraMmNrc::from('12/MaMaNa(N)439042')->toInstance())
        ->toBeInstanceOf(Nrc::class)
        ->toHaveMethods([
            'getFormat',
            'getOrigin',
            'getStateNo',
            'getState',
            'getDefaultDelimiters',
            'getTownshipCode',
            'getType',
            'getNumbers',
            'toUnformattedString',
            'toString',
        ]);
});

it('should throw if NRC is invalid', function (): void {
    expect(LaraMmNrc::of('81 /  MaMaNa [    Pyu} 439042')->toInstance(Format::EN));
})->throws(Exception::class, 'Invalid NRC!');
