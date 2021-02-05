<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Twitcher;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;

class AddTwitcherType extends AbstractType
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categoriesRepo = $this->em->getRepository(Category::class);
        $categories = $categoriesRepo->findAll();

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('certified', CheckboxType::class, [
                'label' => 'Est certifié',
                'required' => false

            ])
            ->add('dateInscription', DateType::class, [
                'label' => 'Date d\'inscription',
                'widget' => 'single_text'
            ])
            ->add('categories', ChoiceType::class, [
                'label' => 'Categorie',
                'multiple' => true,
                'choices' => $categories,
                'choice_label' => function ($value) {
                    return $value->getName();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Twitcher::class,
        ]);
    }
}
