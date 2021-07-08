<?php

namespace Padam87\GlsBundle\Form;

use Padam87\GlsBundle\Model\Parcel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParcelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clientNumber', IntegerType::class, ['required' => false])
            ->add('clientReference', TextType::class)
            ->add('count', IntegerType::class)
            ->add('codAmount', NumberType::class)
            ->add('codReference', TextType::class)
            ->add('content', TextType::class)
            ->add('pickupDate', DateType::class, ['widget' => 'single_text'])
            ->add('pickupAddress', AddressType::class)
            ->add('deliveryAddress', AddressType::class)
            ->add('serviceList', ServicesType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'data_class' => Parcel::class,
                    'label_format' => 'gls.parcel.%name%',
                ]
            )
        ;
    }
}
