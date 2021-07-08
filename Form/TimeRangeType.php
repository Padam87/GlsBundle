<?php

namespace Padam87\GlsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimeRangeType extends AbstractType implements DataTransformerInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', TimeType::class)
            ->add('to', TimeType::class)
        ;

        $builder->addModelTransformer($this);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'label_format' => 'gls.time_range.%name%',
                ]
            )
        ;
    }

    public function transform($value)
    {
        return $value;
    }

    public function reverseTransform($value)
    {
        if ($value === null) {
            return $value;
        }

        /** @var \DateTime $from */
        $from = $value['from'];

        /** @var \DateTime $to */
        $to = $value['to'];

        return sprintf('%s-%s', $from->format('H:i'), $to->format('H:i'));
    }
}
