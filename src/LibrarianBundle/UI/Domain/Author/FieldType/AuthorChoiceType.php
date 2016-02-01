<?php

namespace FractalizeR\LibrarianBundle\UI\Domain\Author\FieldType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorChoiceType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'attr' => [
                    'data-form-type' => self::class,
                ],
            ]
        );
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
