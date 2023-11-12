<?php

declare(strict_types=1);

use Thuraaung\LaraMmNrc\Nrc;
use Thuraaung\LaraMmNrc\Format;

beforeEach(function (): void {
    $this->mmNrc = new Nrc(
        format: Format::MM,
        origin: "၃  / ဘအန(ပြု )  ၄၃၉၀၄၂",
        defaultDelimiters: ['  / ', '(', ' )  '],
        stateNo: '၃',
        townshipCode: 'ဘအန',
        type: 'ပြု',
        numbers: '၄၃၉၀၄၂',
    );

    $this->enNrc = new Nrc(
        format: Format::EN,
        origin: "3  / BaANa(P )  439042",
        defaultDelimiters: ['  / ', '(', ' )  '],
        stateNo: '3',
        townshipCode: 'BaANa',
        type: 'P',
        numbers: '439042',
    );
});

it("can create Nrc object", function (): void {
    expect($this->mmNrc)
        ->toBeInstanceOf(Nrc::class)
        ->toHaveMethods([
            'getFormat',
            'getOrigin',
            'getStateNo',
            'getState',
            'getDefaultDelimiters',
            'getTownshipCode',
            'getTownship',
            'getType',
            'getNumbers',
            'toUnformattedString',
            'toString',
        ]);
});

it('can get NRC format', function (): void {
    expect($this->mmNrc)
        ->getFormat()
        ->toBe(Format::MM);

    expect($this->enNrc)
        ->getFormat()
        ->toBe(Format::EN);
});

it('can get NRC origin', function (): void {
    expect($this->mmNrc)
        ->getOrigin()
        ->toBe("၃  / ဘအန(ပြု )  ၄၃၉၀၄၂");

    expect($this->enNrc)
        ->getOrigin()
        ->toBe("3  / BaANa(P )  439042");
});

it('can get NRC state number', function (): void {
    expect($this->mmNrc)
        ->getStateNo()
        ->toBe("၃");

    expect($this->enNrc)
        ->getStateNo()
        ->toBe("3");
});

it('can get NRC state name', function (): void {
    expect($this->mmNrc)
        ->getState()
        ->toBe("ကရင် ပြည်နယ်");

    expect($this->enNrc)
        ->getState()
        ->toBe("Kayin State");
});

it('can get NRC default delimiters', function (): void {
    expect($this->mmNrc)
        ->getDefaultDelimiters()
        ->toBe(['  / ', '(', ' )  ']);

    expect($this->enNrc)
        ->getDefaultDelimiters()
        ->toBe(['  / ', '(', ' )  ']);
});

it('can get NRC township code', function (): void {
    expect($this->mmNrc)
        ->getTownshipCode()
        ->toBe('ဘအန');

    expect($this->enNrc)
        ->getTownshipCode()
        ->toBe('BaANa');
});

it('can get NRC township name', function (): void {
    expect($this->mmNrc)
        ->getTownship()
        ->toBe('ဘားအံမြို့နယ်');

    expect($this->enNrc)
        ->getTownship()
        ->toBe('Hpa-an Township');
});

it('can get NRC type', function (): void {
    expect($this->mmNrc)
        ->getType()
        ->toBe('ပြု');

    expect($this->enNrc)
        ->getType()
        ->toBe('P');
});

it('can get NRC numbers', function (): void {
    expect($this->mmNrc)
        ->getNumbers()
        ->toBe('၄၃၉၀၄၂');

    expect($this->enNrc)
        ->getNumbers()
        ->toBe('439042');
});

it('can get NRC unformatted string', function (): void {
    expect($this->mmNrc)
        ->toUnformattedString()
        ->toBe('၃  / ဘအန(ပြု )  ၄၃၉၀၄၂');

    expect($this->enNrc)
        ->toUnformattedString()
        ->toBe('3  / BaANa(P )  439042');
});

it('can get NRC formatted string', function (): void {
    expect($this->mmNrc)
        ->toString()
        ->toBe('၃/ဘအန(ပြု)၄၃၉၀၄၂');

    expect($this->enNrc)
        ->toString()
        ->toBe('3/BaANa(P)439042');

    expect((string) $this->mmNrc)
        ->toBe('၃/ဘအန(ပြု)၄၃၉၀၄၂');

    expect((string) $this->enNrc)
        ->toBe('3/BaANa(P)439042');
});
