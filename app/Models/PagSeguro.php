<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client as Guzzle;
use App\Models\Cart;

class PagSeguro extends Model
{
    use PagSeguroTrait;

    private $cart, $reference, $user;
    private $currency = 'BRL';

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
        $this->reference = uniqid(date('YmdHis'));
        $this->user = auth()->user();
    }

    public function getSessionId()
    {
        $params = $this->getConfigs();
        $params = http_build_query($params);

        $guzzle = new Guzzle;
        $response = $guzzle->request('POST', config('pagseguro.url_transparente_session'), [
            'query' => $params
        ]);
        $body = $response->getBody();
        $contents = $body->getContents();

        $xml = simplexml_load_string($contents);

        $code = $xml->id;
        return $code;
    }

    public function paymentBillet($sendHash)
    {
        //dd($this->getSender());
        //dd($this->getShipping());

        $params = [
            'senderHash' => $sendHash,
            'paymentMode' => 'default',
            'paymentMethod' => 'boleto',
            'currency' => $this->currency,
            'reference' => $this->reference,
        ];

        $params = array_merge($params, $this->getConfigs());
        $params = array_merge($params, $this->getItems());
        $params = array_merge($params, $this->getSender());
        $params = array_merge($params, $this->getShipping());

        $guzzle = new Guzzle;
        $response = $guzzle->request('POST', config('pagseguro.url_payment_transparente'), [
            'form_params' => $params
        ]);
        $body = $response->getBody();
        $contents = $body->getContents();

        $xml = simplexml_load_string($contents);

        return [
            'success'       =>true,
            'reference'     => (string)$xml->reference,
            'code'          => (string)$xml->code,
            'payment_link'  => $xml->paymentLink
        ];
    }

    public function paymentCredCard($request)
    {
        $params = [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
            'senderHash' => $request->sendHash,
            'paymentMode' => 'default',
            'paymentMethod' => 'creditCard',
            'currency' => 'BRL',
            'itemId1' => '0001',
            'itemDescription1' => 'Produto PagSeguroI',
            'itemAmount1' => '99999.99',
            'itemQuantity1' => '1',
            'itemWeight1' => '1000',
            'itemId2' => '0002',
            'itemDescription2' => 'Produto PagSeguroII',
            'itemAmount2' => '99999.98',
            'itemQuantity2' => '2',
            'itemWeight2' => '750',
            'reference' => 'REF1234',
            'senderName' => 'Jose Comprador',
            'senderAreaCode' => '99',
            'senderPhone' => '99999999',
            'senderEmail' => 'c81481552971465874904@sandbox.pagseguro.com.br',
            'senderCPF' => '04512902163',
            'shippingType' => '1',
            'shippingAddressStreet' => 'Av. PagSeguro',
            'shippingAddressNumber' => '9999',
            'shippingAddressComplement' => '99o andar',
            'shippingAddressDistrict' => 'Jardim Internet',
            'shippingAddressPostalCode' => '99999999',
            'shippingAddressCity' => 'Cidade Exemplo',
            'shippingAddressState' => 'SP',
            'shippingAddressCountry' => 'ATA',
            'shippingCost' => '21.50',
            'creditCardToken' => $request->cardToken,
            'installmentQuantity' => '1',
            'installmentValue' => '300021.45',
            'noInterestInstallmentQuantity' => '2',
            'creditCardHolderName' => 'Jose Comprador',
            'creditCardHolderCPF' => '11475714734',
            'creditCardHolderBirthDate' => '01/01/1900',
            'creditCardHolderAreaCode' => '99',
            'creditCardHolderPhone' => '99999999',
            'billingAddressStreet' => 'Av. PagSeguro',
            'billingAddressNumber' => '9999',
            'billingAddressComplement' => '99o andar',
            'billingAddressDistrict' => 'Jardim Internet',
            'billingAddressPostalCode' => '99999999',
            'billingAddressCity' => 'Cidade Exemplo',
            'billingAddressState' => 'SP',
            'billingAddressCountry' => 'ATA',
        ];

        $guzzle = new Guzzle;
        $response = $guzzle->request('POST', config('pagseguro.url_payment_transparente_sandbox'), [
            'form_params' => $params
        ]);
        $body = $response->getBody();
        $contents = $body->getContents();

        $xml = simplexml_load_string($contents);

       return $xml->code;
    }

    public function getStatusTransaction($notificationCode)
    {
        $configs = $this->getConfigs();
        $params = http_build_query($configs);

        $guzzle = new Guzzle;
        $response = $guzzle->request('GET', config('pagseguro.url_notification')."/{$notificationCode}", [
            'query' => $params,
        ]);
        $body = $response->getBody();
        $contents = $body->getContents();

        $xml = simplexml_load_string($contents);

        return [
            'status'    => (string) $xml->status,
            'reference' => (string) $xml->reference,
        ];
    }

    /*
    public function generate()
    {
        $params = [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
            'currency' => 'BRL',
            'itemId1' => '0001',
            'itemDescription1' => 'Produto PagSeguroI',
            'itemAmount1' => '99999.99',
            'itemQuantity1' => '1',
            'itemWeight1' => '1000',
            'itemId2' => '0002',
            'itemDescription2' => 'Produto PagSeguroII',
            'itemAmount2' => '99999.98',
            'itemQuantity2' => '2',
            'itemWeight2' => '750',
            'reference' => 'REF1234',
            'senderName' => 'Jose Comprador',
            'senderAreaCode' => '99',
            'senderPhone' => '99999999',
            'senderEmail' => 'comprador@uol.com.br',
            'shippingType' => '1',
            'shippingAddressStreet' => 'Av. PagSeguro',
            'shippingAddressNumber' => '9999',
            'shippingAddressComplement' => '99o andar',
            'shippingAddressDistrict' => 'Jardim Internet',
            'shippingAddressPostalCode' => '99999999',
            'shippingAddressCity' => 'Cidade Exemplo',
            'shippingAddressState' => 'SP',
            'shippingAddressCountry' => 'ATA'
        ];

        $params = http_build_query($params);
        $guzzle = new Guzzle;
        $response = $guzzle->request('POST', config('pagseguro.url_checkout_sandbox'), [
            'query' => $params
            ]);
        $body = $response->getBody();
        $contents = $body->getContents();

        $xml = simplexml_load_string($contents);
        $code = $xml->code;
        return $code;
    }
    */

}
