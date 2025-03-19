<?php
declare(strict_types=1);

namespace Eekes\Sulu\FormCitySelectBundle\Service;

use Eekes\Sulu\FormCitySelectBundle\Service\Model\City;

readonly class CityParser
{
    /**
     * @return City[]
     */
    public function parse(string $countryCode): array
    {
        $file = __DIR__ . '/../Resources/countries/' . $countryCode . '.json';
        $data = json_decode(file_get_contents($file), true);

        $cities = [];

        foreach ($data as $cityData) {
            $cities[] = new City($cityData['name'], (string) $cityData['zip'], $countryCode);
        }

        return $cities;
   }
}
