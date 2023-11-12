<?php

declare(strict_types=1);

namespace Thuraaung\LaraMmNrc;

use Thuraaung\ConfigTypes\Facades\Config;

/**
 * NRC class.
 *
 * Format - 12/KaMaTa(P)000081
 */
final class Nrc
{
    public function __construct(
        private Format $format,
        private string $origin,
        private array $defaultDelimiters,
        private string $stateNo,
        private string $townshipCode,
        private string $type,
        private string $numbers,
    ) {
    }

    /**
     * Get the format.
     */
    public function getFormat(): Format
    {
        return $this->format;
    }

    /**
     * Get the origin.
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * Get the state number.
     */
    public function getStateNo(): string
    {
        return $this->stateNo;
    }

    /**
     * Get the state name.
     */
    public function getState(): string
    {
        return Config::setInitKey('lara-mm-nrc.states_and_divisions')
            ->string("{$this->format->value}.{$this->stateNo}");
    }

    /**
     * Get the default delimiters.
     */
    public function getDefaultDelimiters(): array
    {
        return $this->defaultDelimiters;
    }

    /**
     * Get the township code.
     */
    public function getTownshipCode(): string
    {
        return $this->townshipCode;
    }

    /**
     * Get the township name.
     */
    public function getTownship(): ?string
    {
        /** @var ?string $township */
        $township = Config::setInitKey("lara-mm-nrc.townships")
            ->collect($this->stateNo)
            ->get($this->townshipCode);

        return $township;
    }

    /**
     * Get the NRC type.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the NRC numbers.
     */
    public function getNumbers(): string
    {
        return $this->numbers;
    }

    /**
     * To unformatted string.
     */
    public function toUnformattedString(): string
    {
        [$d1, $d2, $d3] = $this->defaultDelimiters;

        return "{$this->stateNo}{$d1}{$this->townshipCode}{$d2}{$this->type}{$d3}{$this->numbers}";
    }

    /**
     * To string.
     */
    public function toString(): string
    {
        return "{$this->stateNo}/{$this->townshipCode}({$this->type}){$this->numbers}";
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
