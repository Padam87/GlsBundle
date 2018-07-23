<?php

namespace Padam87\GlsBundle\Service;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ParcelApi
{
    private $config = [];

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    public function getClient(): \SoapClient
    {
        return new \SoapClient($this->config['parcel_wsdl']);
    }

    public function createParcel($data): array
    {
        $data = $this->resolveData($data);

        return (array) $this->getClient()->__soapCall('printlabel', $data);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function resolveData(array $data)
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setRequired(
                [
                    'username',
                    'password',
                    'senderid',
                    'sender_name',
                    'sender_address',
                    'sender_city',
                    'sender_zipcode',
                    'sender_country',
                    'consig_name',
                    'consig_address',
                    'consig_city',
                    'consig_zipcode',
                    'consig_country',
                    'pcount',
                    'pickupdate',
                    'printertemplate',
                    'printit',
                    'timestamp',
                ]
            )
            ->setDefaults(
                [
                    'sender_contact' => '',
                    'sender_phone' => '',
                    'sender_email' => '',
                    'consig_contact' => '',
                    'consig_phone' => '',
                    'consig_email' => '',
                    'content' => '',
                    'clientref' => '',
                    'codamount' => 0.0,
                    'codref' => '',
                    'services' => '',
                    'timestamp' => date('YmdHis'),
                    'hash' => '',
                    'customlabel' => '',
                    'is_autoprint_pdfs' => false,
                ]
            )
            ->setDefaults($this->config['config'])
        ;

        $order = [
            'username', 'password', 'senderid',
            'sender_name', 'sender_address', 'sender_city', 'sender_zipcode', 'sender_country',
            'sender_contact', 'sender_phone', 'sender_email',
            'consig_name', 'consig_address', 'consig_city', 'consig_zipcode', 'consig_country',
            'consig_contact', 'consig_phone', 'consig_email',
            'pcount', 'pickupdate', 'content', 'clientref', 'codamount', 'codref',
            'services', 'printertemplate', 'printit', 'timestamp', 'hash', 'customlabel', 'is_autoprint_pdfs',
        ];

        $data = $resolver->resolve($data);
        $return = [];

        foreach ($order as $field) {
            $return[$field] = $data[$field];
        }

        $return['hash'] = $this->hash($return);

        return $return;
    }

    /**
     * @param $data
     *
     * @return string
     */
    protected function hash($data)
    {
        $excluded = ['services', 'printertemplate', 'printit', 'timestamp', 'hash', 'customlabel', 'is_autoprint_pdfs'];

        $hashBase = '';

        foreach ($data as $field => $value) {
            if (in_array($field, $excluded)) {
                continue;
            }

            $hashBase .= $data[$field];
        }

        return sha1($hashBase);
    }
}
