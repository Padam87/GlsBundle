<?php

namespace Padam87\GlsBundle\Form;

use Padam87\GlsBundle\Model\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
        ;

        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
            $this->codeListener($event);
        });
    }

    public function codeListener(FormEvent $event)
    {
        /** @var Service $service */
        $service = $event->getData();
        $form = $event->getForm();

        $code = $service === null ? null : $service->getCode();

        switch ($code) {
            case 'DDS':
                $form->add('value', DateType::class, ['required' => false, 'widget' => 'single_text']);

                break;
            case 'FDS':
                $form->add('value', EmailType::class, ['required' => false]);

                break;
            case 'CS1':
            case 'FSS':
            case 'SM1':
            case 'SM2':
            case 'SAT':
                $form->add('value', TextType::class, ['required' => false, 'attr' => ['class' => 'phone-number']]);

                break;
            case 'SDS':
                $form->add('value', TimeRangeType::class, ['required' => false]);

                break;
            case '24H':
            case 'T09':
            case 'T10':
            case 'T12':
            case 'XS':
                break; // no value required
            default:
                $form->add('value', TextType::class, ['required' => false]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'data_class' => Service::class,
                    'label_format' => 'gls.service.%name%',
                ]
            )
        ;
    }
}
