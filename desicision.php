<?php

declare(strict_types=1);

$nrc = '';

LaraMmNrc::from($nrc)->toEng();
LaraMmNrc::from($nrc)->toMm();
LaraMmNrc::of($nrc)->isValid();
LaraMmNrc::of($nrc)->isInvalid();
LaraMmNrc::of($nrc)->isMm();
LaraMmNrc::of($nrc)->isEn();
LaraMmNrc::of($nrc)->toInstance();
