<?php

namespace Stakovicz\UXCollection\DependencyInjection;

use Stakovicz\UXCollection\Form\UXCollectionType;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @internal
 */
class UXCollectionExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container)
    {
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $container
            ->setDefinition('form.ux_collection', new Definition(UXCollectionType::class))
            ->addTag('form.type')
            ->setPublic(false)
        ;
    }
}
