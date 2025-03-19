# SuluFormCitySelectBundle

The SuluFormCitySelectBundle adds a city select field to [Sulu forms](https://github.com/sulu/SuluFormBundle), enabling users to easily 
select cities from a list within forms on the frontend.

## Installation
Install using composer:

```
composer require eekes/sulu-form-city-select-bundle
```
Add the bundle to config/bundles.php if it's not automatically added:

```
Eekes\Sulu\FormCitySelectBundle\EekesSuluFormCitySelectBundle::class => ['all' => true],
```

## Usage

Once installed, the field will be automatically available in your list of form fields.
