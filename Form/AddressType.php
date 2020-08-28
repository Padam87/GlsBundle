<?php

namespace Padam87\GlsBundle\Form;

use Doctrine\DBAL\Types\IntegerType;
use Padam87\GlsBundle\Model\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('street', TextType::class)
            ->add('houseNumber', TextType::class, ['required' => false])
            ->add('city', TextType::class)
            ->add('zipCode', TextType::class)
            ->add('countryIsoCode', CountryType::class, ['required' => false])
            ->add('contactName', TextType::class, ['required' => false])
            ->add('contactPhone', TextType::class, ['required' => false])
            ->add('contactEmail', EmailType::class, ['required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'data_class' => Address::class,
                    'label_format' => 'gls.address.%name%',
                ]
            )
        ;
    }
}
