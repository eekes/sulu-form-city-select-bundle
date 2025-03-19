<?php
declare(strict_types=1);

namespace Eekes\Sulu\FormCitySelectBundle\Service\Model;

readonly class City
{
    public function __construct(
        public string $name,
        public string $zipCode,
        public string $countryCode,
    ) {}
}
