<?php

namespace Symfony\UX\FormCollection\DependencyInjection;

use Symfony\UX\FormCollection\Form\CollectionType;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @internal
 */
class FormCollectionExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container)
    {
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $container
            ->setDefinition('form.ux_collection', new Definition(CollectionType::class))
            ->addTag('form.type')
            ->setPublic(false)
        ;
    }
}
