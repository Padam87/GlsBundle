<?php

namespace Padam87\GlsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceParameterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        switch ($options['code']) {
            case 'DDS':
                $builder->add('Value', DateType::class, ['required' => false, 'label' => false, 'widget' => 'single_text']);

                break;
            case 'FDS':
                $builder->add('Value', EmailType::class, ['required' => false, 'label' => false]);

                break;
            case 'CS1':
            case 'FSS':
            case 'SM1':
            case 'SM2':
            case 'SAT':
                $builder->add('Value', TextType::class, ['required' => false, 'label' => false, 'attr' => ['class' => 'phone-number']]);

                break;
            case 'SDS':
                $builder
                    ->add('TimeFrom', TimeType::class)
                    ->add('TimeTo', TimeType::class)
                    ->addModelTransformer(
                        new CallbackTransformer(
                            function ($value) {
                                return $value;
                            },
                            function ($value) {
                                if ($value['TimeFrom'] instanceof \DateTimeInterface) {
                                    $value['TimeFrom'] = $value['TimeFrom']->format('c');
                                }

                                if ($value['TimeTo'] instanceof \DateTimeInterface) {
                                    $value['TimeTo'] = $value['TimeTo']->format('c');
                                }

                                return $value;
                            }
                        )
                    )
                ;

                break;
            case '24H':
            case 'T09':
            case 'T10':
            case 'T12':
            case 'XS':
                break; // no value required
            default:
                $builder->add('Value', TextType::class, ['required' => false, 'label' => false]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('code')
            ->setDefaults(
                [
                    'label_format' => 'gls.service_parameter.%name%',
                ]
            )
        ;
    }
}
