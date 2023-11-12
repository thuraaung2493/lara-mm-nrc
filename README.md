# Laravel Myanmar NRC (**LaraMMNrc**)

**It supports _Laravel 9+_ and _PHP 8.2_+**

-   [Laravel Myanmar NRC (**LaraMMNrc**)](#laravel-myanmar-nrc-larammnrc)
    -   [Description](#description)
    -   [Installation](#installation)
    -   [Publish the config file](#publish-the-config-file)
    -   [Usage](#usage)
        -   [To Convert](#to-convert)
        -   [To Check](#to-check)
        -   [Nrc Instance](#nrc-instance)

## Description

This package facilitates the conversion of Myanmar NRC to the English format and vice versa in the Myanmar format. Furthermore, it offers additional useful features.

## Installation

Require this package with composer using the following command:

```bash
composer require thuraaung2493/lara-mm-nrc
```

## Publish the config file

```bash
php artisan vendor:publish --provider="Thuraaung\LaraMmNrc\LaraMmNrcServiceProvider" --tag="lara-mm-nrc"
```

## Usage

### To Convert

```bash
  use Thuraaung\LaraMmNrc\LaraMmNrc;

  $mmNrc = "၈/မမန(နိုင်)၄၃၉၀၄၂"
  $enNrc = "8/MaMaNa(Naing)439042"
  LaraMmNrc::from($mmNrc)->toEng(); // "8/MaMaNa(Naing)439042"
  LaraMmNrc::from($enNrc)->toMm(); // "၈/မမန(နိုင်)၄၃၉၀၄၂"
  LaraMmNrc::of($mmNrc)->toInstance(); // Nrc
```

### To Check

```bash
  use Thuraaung\LaraMmNrc\LaraMmNrc;

  $nrc = "၈/မမန(နိုင်)၄၃၉၀၄၂"
  LaraMmNrc::of($nrc)->isValid(); // true
  LaraMmNrc::of($nrc)->isInvalid(); // false
  LaraMmNrc::of($nrc)->isMm(); // true
  LaraMmNrc::of($nrc)->isEn(); // false
```

### Nrc Instance

```bash
  use Thuraaung\LaraMmNrc\LaraMmNrc;

  $enNrc = "8/MaMaNa(Naing)439042"

  $nrc = LaraMmNrc::from($mmNrc)->toInstance();

  $nrc->getFormat();
  $nrc->getOrigin();
  $nrc->getStateNo();
  $nrc->getState();
  $nrc->getDefaultDelimiters();
  $nrc->getTownshipCode();
  $nrc->getTownship();
  $nrc->getType();
  $nrc->getNumbers();
  $nrc->toUnformattedString();
  $nrc->toString();

  echo $nrc // "NRC string"
```
