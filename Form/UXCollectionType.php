<?php

namespace Stakovicz\UXCollection\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @final
 * @experimental
 */
class UXCollectionType extends AbstractType
{
    public function getParent()
    {
        return CollectionType::class;
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
    }

    public function getBlockPrefix()
    {
        return 'ux_collection';
    }
}
