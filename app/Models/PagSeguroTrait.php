<?php

namespace App\Models;
use GuzzleHttp\Client as Guzzle;

trait PagSeguroTrait
{
    public function getConfigs()
    {
        return [
            'email' => config('pagseguro.email'),
            'token' => config('pagseguro.token'),
        ];
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getItems()
    {
        $items = [];
        $itemsCart = $this->cart->getItems();
        $position = 1;

        foreach ($itemsCart as $item){
            $items["itemId{$position}"]             = $item['item']->id;
            $items["itemDescription{$position}"]    = $item['item']->description;
            $items["itemAmount{$position}"]         = "{$item['item']->price}0";
            $items["itemQuantity{$position}"]       = $item['qtd'];
            //$items["itemWeight{$position}"]         = '0';
            $position++;
        }
        return $items;
        /*
        return [
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
        ];
        */
    }

    public function getSender()
    {
        return [
            'senderName'     => $this->user->name,
            'senderAreaCode' => $this->user->area_code,
            'senderPhone'    => $this->user->phone,
            'senderEmail'    => $this->user->email,
            'senderCPF'      => $this->user->cpf,
        ];
    }

    public function getShipping()
    {
        return [
            'shippingType'              => '1',
            'shippingAddressStreet'     => $this->user->street,
            'shippingAddressNumber'     => $this->user->number,
            'shippingAddressComplement' => $this->user->complement,
            'shippingAddressDistrict'   => $this->user->district,
            'shippingAddressPostalCode' => $this->user->postal_code,
            'shippingAddressCity'       => $this->user->city,
            'shippingAddressState'      => $this->user->state,
            'shippingAddressCountry'    => $this->user->country,
        ];
    }
    /*
    public function getSender()
    {
        return [
            'senderName' => 'Jose Comprador',
            'senderAreaCode' => '99',
            'senderPhone' => '99999999',
            'senderEmail' => 'c81481552971465874904@sandbox.pagseguro.com.br',
            'senderCPF' => '04512902163',
        ];
    }

    public function getShipping()
    {
        return [
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
    }
    */
}