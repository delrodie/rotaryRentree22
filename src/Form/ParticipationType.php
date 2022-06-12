<?php

namespace App\Form;

use App\Entity\Participation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
	        ->add('nom', TextType::class,['attr'=>['class'=>'form-control','autocomplete'=>"off"],'label'=>'Nom de famille'])
	        ->add('prenoms', TextType::class,['attr'=>['class'=>'form-control','autocomplete'=>"off"]])
	        ->add('email', EmailType::class,['attr'=>['class'=>'form-control','autocomplete'=>"off"]])
	        ->add('contact', TelType::class,['attr'=>['class'=>'form-control','autocomplete'=>"off"]])
	        ->add('club', TextType::class,['attr'=>['class'=>'form-control','autocomplete'=>"off"]])
	        ->add('nombrePlace', IntegerType::class,['attr'=>['class'=>'form-control','autocomplete'=>"off"], 'label'=>'Nombre de places'])
	        ->add('poste', TextType::class,['attr'=>['class'=>'form-control','autocomplete'=>"off"], 'label'=>'Fonction'])
	        //->add('montant')
            //->add('reference')
            //->add('slug')
            //->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participation::class,
        ]);
    }
}
