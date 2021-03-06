<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\UX\FormCollection\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType as BaseCollectionType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @final
 * @experimental
 */
class CollectionType extends AbstractType
{
    public function getParent()
    {
        return BaseCollectionType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'button_add' => [
                'text' => 'Add',
                'attr' => ['class' => 'btn btn-outline-primary'],
            ],
            'button_delete' => [
                'text' => 'Remove',
                'attr' => ['class' => 'btn btn-outline-secondary'],
            ],
        ]);
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        parent::finishView($view, $form, $options);

        $view->vars['button_add'] = $options['button_add'];
        $view->vars['button_delete'] = $options['button_delete'];
        $view->vars['prototype_name'] = $options['prototype_name'];
    }

    public function getBlockPrefix()
    {
        return 'form_collection';
    }
}
