# UX Form Collection

Symfony UX Form collection is a Symfony bundle providing light UX for collection
in Symfony Forms.

## Installation

UX Form Collection requires PHP 7.2+ and Symfony 4.4+.

Install this bundle using Composer and Symfony Flex:

```sh
composer require stakovicz/ux-collection

# Don't forget to install the JavaScript dependencies as well and compile
yarn install --force
yarn encore dev
```

Also make sure you have at least version 2.0 of [@symfony/stimulus-bridge](https://github.com/symfony/stimulus-bridge)
in your `package.json` file.

## Usage

The most common usage of Form Collection is to use it as a replacement of
the native CollectionType class:

```php
// ...
use Stakovicz\UXCollection\Form\UXCollectionType;

class BlogFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            ->add('comments', UXCollectionType::class, [
                // ...
                'button_add' => [
                     // Default text for the add button
                    'text' => 'Add',    
                    // Default attr class for the add button
                    'attr' => ['class' => 'btn btn-outline-primary'] 
                ],
                'button_delete' => [
                    // Default text for the delete button
                    'text' => 'Remove',    
                    // Default class for the delete button
                    'attr' => ['class' => 'btn btn-outline-secondary']    
                ],
            ])
            // ...
        ;
    }

    // ...
}
```
