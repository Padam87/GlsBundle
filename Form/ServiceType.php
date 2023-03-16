<?php

namespace Padam87\GlsBundle\Form;

use Padam87\GlsBundle\Model\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'code',
                ChoiceType::class,
                [
                    'choices' => array_combine(Service::$codes, Service::$codes),
                    'choice_translation_domain' => 'gls_services',
                ]
            )
            ->add('parameter', ServiceParameterType::class, ['code' => $options['code']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('code')
            ->setDefaults(
                [
                    'data_class' => Service::class,
                    'label_format' => 'gls.service.%name%',
                ]
            )
        ;
    }
}
