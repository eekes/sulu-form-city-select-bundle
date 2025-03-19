<?php

declare(strict_types=1);

namespace Eekes\Sulu\FormCitySelectBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('eekes_sulu_form_city_select');
        return $treeBuilder;
    }
}
