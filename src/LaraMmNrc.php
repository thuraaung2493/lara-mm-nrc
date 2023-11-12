<?php

declare(strict_types=1);

namespace Thuraaung\LaraMmNrc;

use Exception;
use Illuminate\Support\Arr;
use Thuraaung\ConfigTypes\Facades\Config;
use Thuraaung\LaraMmNrc\Contracts\LaraMmNrcInterface;
use Thuraaung\LaraMmNrc\Utils\NrcConverter;
use Thuraaung\LaraMmNrc\Utils\NumberConverter;

use function is_string;
use function array_values;

final class LaraMmNrc implements LaraMmNrcInterface
{
    public function __construct(
        private string $nrc
    ) {
    }

    /**
     * Get a new LaraMmNrc object of the given NRC string.
     */
    public static function of(string $nrc): self
    {
        return new self($nrc);
    }

    /**
     * Get a new LaraMmNrc object from the given NRC string.
     */
    public static function from(string $nrc): self
    {
        return self::of($nrc);
    }

    /**
     * Change NRC string to instance.
     *
     * @throws Exception;
     */
    public function toInstance(?Format $format = null): Nrc
    {
        if (null === $format) {
            $format = $this->isEn() ? Format::EN : Format::MM;
        }

        if (preg_match($this->getPattern(), $this->nrc, $matches)) {
            return new Nrc(
                format: $format,
                origin: $matches[0],
                defaultDelimiters: array_values(Arr::only($matches, [2, 4, 6])),
                stateNo: $matches[1],
                townshipCode: $matches[3],
                type: $matches[5],
                numbers: $matches[7],
            );
        }

        throw new Exception('Invalid NRC!');
    }

    /**
     * Converts to NRC in English format.
     */
    public function toEn(): Nrc
    {
        return $this->convert(new ConvertOption(Format::MM, Format::EN));
    }

    /**
     * Converts to NRC in Myanmar format.
     */
    public function toMm(): Nrc
    {
        return $this->convert(new ConvertOption(Format::EN, Format::MM));
    }

    /**
     * Is the NRC valid?
     */
    public function isValid(): bool
    {
        return (bool) \preg_match($this->getPattern(), $this->nrc);
    }

    /**
     * Is the NRC invalid?
     */
    public function isInvalid(): bool
    {
        return ! $this->isValid();
    }

    /**
     * Is the NRC in English format?
     */
    public function isEn(): bool
    {
        return (bool) \preg_match($this->getPattern(Format::EN), $this->nrc);
    }

    /**
     * Is the NRC in Myanmar format?
     */
    public function isMm(): bool
    {
        return (bool) \preg_match($this->getPattern(Format::MM), $this->nrc);
    }

    /**
     * Get the regex pattern.
     */
    private function getPattern(string|Format $format = '*'): string
    {
        $format = is_string($format) ? $format : $format->value;

        return Config::string("lara-mm-nrc.patterns.{$format}");
    }

    /**
     * Converts the NRC using the provided option.
     */
    private function convert(ConvertOption $option): Nrc
    {
        $nrc = $this->toInstance($option->to);
        $converter = new NrcConverter();
        $townshipCode = $converter->township($nrc->getTownshipCode(), $option);
        $format = $converter->type($nrc->getType(), $option);
        $stateNo = NumberConverter::convert($nrc->getStateNo(), $option);
        $numbers = NumberConverter::convert($nrc->getNumbers(), $option);

        return new Nrc(
            format: $option->from,
            origin: $nrc->getOrigin(),
            defaultDelimiters: $nrc->getDefaultDelimiters(),
            stateNo: $stateNo,
            townshipCode: $townshipCode,
            type: $format,
            numbers: $numbers,
        );
    }
}
