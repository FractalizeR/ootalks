<?php

namespace FractalizeR\LibrarianBundle\UI\Domain\Article\Form;

use FractalizeR\LibrarianBundle\Logic\Domain\Article\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * ArticleForm
 *
 * @package FractalizeR\LibrarianBundle\UI\Domain\Article\Form
 */
class ArticleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('contents', TextareaType::class, ['attr' => ['rows' => 30]])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'empty_data' => new Article("", ""),
                'data_class' => Article::class,
            ]
        );
    }
}
