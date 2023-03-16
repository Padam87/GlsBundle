<?php

namespace Padam87\GlsBundle\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Padam87\GlsBundle\Model\Collection;
use Padam87\GlsBundle\Model\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class ServicesType extends AbstractType implements DataTransformerInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this);

        foreach (Service::$codes as $service) {
            $form = $builder->create(
                $service,
                null,
                [
                    'compound' => true,
                    'label' => $service,
                    'translation_domain' => 'gls_services',
                ]
            );

            $form
                ->add('enabled', CheckboxType::class, ['required' => false, 'label' => 'gls.service.enabled'])
                ->add('service', ServiceType::class, ['code' => $service])
            ;

            $builder->add($form);
        }
    }

    public function transform($value)
    {
        /** @var Collection $services */
        $services = $value;
        $data = new ArrayCollection();

        foreach (Service::$codes as $code) {
            $enabled = true;

            if (null === $service = $services->get($code)) {
                $enabled = false;
                $service = new Service($code);
            }

            $data->set($code, ['enabled' => $enabled, 'service' => $service]);
        }

        return $data;
    }

    public function reverseTransform($value)
    {
        /** @var Collection $services */
        $services = $value;
        $data = new Collection();

        foreach ($services as $code => $config) {
            if (!$config['enabled']) {
                continue;
            }

            $data->set($code, $config['service']);
        }

        return $data;
    }
}
