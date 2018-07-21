# GlsBundle
GLS (East Europe) API wrapper for Symfony

## Installation

```
composer require padam87/gls-bundle
```

## Configuration

```yaml
padam87_gls:
    wsdl: 'https://online.gls-hungary.com/webservices/soap_server.php?wsdl&ver=16.12.15.01'
    tracking_url: 'https://gls-group.eu/app/service/open/rest/HU/en/rstt001?match=%1$s'
    config:
        username: '000000000'
        password: '000000000'
        senderid: '000000000'
```

- **wsdl**: Refer to the API doc for the correct url for the country
- **tracking_url**: The SOAP api does not provide a way to track packages, but GLS europe has an open API, used by the GLS websites
- **config**: username, password and senderid are the only required config options, but **you may use any valid option, and set it as a default value**

#### Optional defaults

```yaml
padam87_gls:
    parcel_wsdl:          'https://online.gls-hungary.com/webservices/soap_server.php?wsdl'
    tracking_url:         'https://gls-group.eu/app/service/open/rest/HU/en/rstt001?match={code}'
    pod_download_url:     'http://online.gls-hungary.com/tt_getPodsClass.php?userID={userid}&senderID={senderid}&pclFrom={code_from}&pclTo={code_to}&lang=hu&directDownload=1&fileType=PDF'
    config:               # Required
        userid:               ~ # Required, Example: required for pod download, GLS usually forgets to provide it unless you ask
        username:             ~ # Required
        password:             ~ # Required
        senderid:             ~ # Required
        sender_name: 'x'
        sender_address: 'x'
        sender_city: 'x'
        sender_zipcode: 'x'
        sender_country: 'HU'
        sender_contact: 'x'
        sender_phone: 'x'
        sender_email: 'x'
        pcount: 1
        printertemplate: 'A6'
        printit: true
```

### Usage

#### Creating a parcel

```php
$api = $this->get('padam87_gls.parcel_api');
$response = $api->createParcel(
    [
        'consig_address' => $sa->getStreet(),
        'consig_city' => $sa->getCity(),
        'consig_country' => $sa->getCountry(),
        'consig_name' => $sa->getRecipient(),
        'consig_zipcode' => $sa->getZipCode(),
        'consig_contact' => $user->getName(),
        'consig_phone' => $user->getPhone(),
        'consig_email' => $user->getEmail(),
        'content' => $order->getCode(),
        'pickupdate' => (new \DateTime('tomorrow'))->format('Y-m-d'),
    ]
);

if (isset($response['successfull']) && $response['successfull']) {
    $pdf = base64_decode($response['pdfdata']);
    $pcls = $response['pcls'];
}
```


#### Parcel information (tracking)

```php
$api = $this->get('padam87_gls.tracking_api');

if (false !== $info = $api->getParcelInformation('00')) {
    $status = $info['progressBar']['statusInfo'];
}
```

The API also allows to fetch multiple parcels in one request:

```php
$provider->getParcelInformation('00,01', true)
```

The returned value will be an array, with the individual tracking codes as keys.
