<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\SearchCar;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minYear', IntegerType::class, ['required' => false, 'label' => "Année de: "])
            ->add('maxYear', IntegerType::class, ['required' => false, 'label' => "Année à: "])
            ->add('immatriculation', TextType::class, ['required' => false, 'label' => "Immatriculation"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchCar::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}
