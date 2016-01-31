<?php

namespace FractalizeR\LibrarianBundle\UI\Domain\Author\Form;

use FractalizeR\LibrarianBundle\Logic\Domain\Author\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * AuthorForm
 *
 * @package FractalizeR\LibrarianBundle\UI\Domain\Author\Form
 */
class AuthorForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('shortBio', TextType::class)
            ->add('www', TextType::class)
            ->add('longBio', TextareaType::class, ['attr' => ['rows' => 30]])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'empty_data' => new Author("", ""),
                'data_class' => Author::class,
            ]
        );
    }
}
