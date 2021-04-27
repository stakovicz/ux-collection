<?php


namespace Stakovicz\UXCollection\DependencyInjection;

use Symfony\Bundle\TwigBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Stakovicz\UXCollection\Form\UXCollectionType;

/**
 * @internal
 */
class UXCollectionExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container)
    {
        // Register the Dropzone form theme if TwigBundle is available
        $bundles = $container->getParameter('kernel.bundles');

        if (!isset($bundles['TwigBundle'])) {
            return;
        }

        $config = $this->processConfiguration(new Configuration(), $container->getExtensionConfig('twig'));
        $config['form_themes'][] = '@UXCollection/form_theme.html.twig';

        $container->prependExtensionConfig('twig', $config);
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
