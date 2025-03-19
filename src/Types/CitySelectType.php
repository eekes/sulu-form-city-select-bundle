<?php
declare(strict_types=1);

namespace Eekes\Sulu\FormCitySelectBundle\Types;

use Eekes\Sulu\FormCitySelectBundle\Service\CityParser;
use Eekes\Sulu\FormCitySelectBundle\Service\Model\City;
use Sulu\Bundle\FormBundle\Dynamic\FormFieldTypeConfiguration;
use Sulu\Bundle\FormBundle\Dynamic\FormFieldTypeInterface;
use Sulu\Bundle\FormBundle\Dynamic\Types\SimpleTypeTrait;
use Sulu\Bundle\FormBundle\Entity\FormField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Countries;

class CitySelectType implements FormFieldTypeInterface
{
    use SimpleTypeTrait;

    public function __construct(
        private readonly CityParser $cityParser
    ) {}

    public function getConfiguration(): FormFieldTypeConfiguration
    {
        return new FormFieldTypeConfiguration(
            'eekes.sulu_form_city_select.city_select_type',
            __DIR__ . '/../Resources/config/form-fields/city_select.xml'
        );
    }

    public function build(FormBuilderInterface $builder, FormField $field, string $locale, array $options): void
    {
        $fieldOptions = $field->getTranslation($locale)->getOptions();

        if (empty($fieldOptions['format'])) {
            $fieldOptions['format'] = '%city%';
        }

        $format = $fieldOptions['format'];

        if (count($fieldOptions['countries']) === 0) {
            return;
        }

        $choices = [];

        foreach ($fieldOptions['countries'] as $countryCode) {
            foreach ($this->cityParser->parse($countryCode) as $city) {
                $choices[] = $city;
            }
        }

        $options['attr']['class'] = 'eekes-city-select';
        $options['multiple'] = false;
        $options['expanded'] = false;
        $options['choices'] = $choices;
        $options['choice_label'] = function (City $city) use ($locale, $format): string {
            $replacements = [
                '%country%' => Countries::getName(strtoupper($city->countryCode), $locale),
                '%zip%' => $city->zipCode,
                '%city%' => $city->name,
            ];

            return strtr($format, $replacements);
        };

        $builder->add($field->getKey(), ChoiceType::class, $options);
    }
}
