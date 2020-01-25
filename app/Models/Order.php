<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = ['user_id', 'reference', 'code', 'status', 'payment_method', 'date'];

    public function scopeUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('qty', 'price');
    }

    public function newOrderProducts($cart, $reference, $code, $status = 1, $paymentMethod = 2)
    {
        $order = $this->create([
            'user_id'           => auth()->user()->id,
            'reference'         => $reference,
            'code'              => $code,
            'status'            => $status,
            'payment_method'    => $paymentMethod,
            'date'              => date('Ymd'),
        ]);
        $productsOrder = [];
        $itemsCart = $cart->getItems();

        foreach ($itemsCart as $item){
            $productsOrder[$item['item']->id] = [
                'qty' => $item['qtd'],
                'price' => $item['item']->price,
            ];
        }
        $order->products()->attach($productsOrder);
    }


    public function getStatus($status)
    {
        $statusA = [
            '1' => 'Aguardando pagamento',  // o comprador iniciou a transação, mas até o momento o PagSeguro não recebeu nenhuma informação.
            '2' => 'Em análise',            // o comprador optou por pagar com um cartão de crédito e o PagSeguro está analisando o risco da transação.
            '3' => 'Paga',                  // a transação foi paga pelo comprador e o PagSeguro já recebeu uma confirmação da instituição financeira responsável pelo processamento.
            '4' => 'Disponível',            // a transação foi paga e chegou ao final de seu prazo de liberação sem ter sido retornada e sem que haja nenhuma disputa aberta.
            '5' => 'Em disputa',            // o comprador, dentro do prazo de liberação da transação, abriu uma disputa.
            '6' => 'Devolvida',             // o valor da transação foi devolvido para o comprador.
            '7' => 'Cancelada',             // a transação foi cancelada sem ter sido finalizada.
            '8' => 'Debitado',              // o valor da transação foi devolvido para o comprador.
            '9' => 'Retenção temporária'    // o comprador contestou o pagamento junto à operadora do cartão de crédito ou abriu uma demanda judicial ou administrativa (Procon).
        ];
        return $statusA[$status];
    }

    public function getPaymentMethod($method)
    {
        $paymentsMethods = [
            '1' => 'Cartão de crédito',     // O comprador pagou pela transação com um cartão de crédito. Neste caso, o pagamento é processado imediatamente ou no máximo em algumas horas, dependendo da sua classificação de risco.
            '2' => 'Boleto',                // O comprador optou por pagar com um boleto bancário. Ele terá que imprimir o boleto e pagá-lo na rede bancária. Este tipo de pagamento é confirmado em geral de um a dois dias após o pagamento do boleto. O prazo de vencimento do boleto é de 3 dias.
            '3' => 'Débito online (TEF)',   // O comprador optou por pagar com débito online de algum dos bancos com os quais o PagSeguro está integrado. O PagSeguro irá abrir uma nova janela com o Internet Banking do banco escolhido, onde o comprador irá efetuar o pagamento. Este tipo de pagamento é confirmado normalmente em algumas horas.
            '4' => 'Saldo PagSeguro',       // O comprador possuía saldo suficiente na sua conta PagSeguro e pagou integralmente pela transação usando seu saldo.
            '5' => 'Oi Paggo *',            // o comprador paga a transação através de seu celular Oi. A confirmação do pagamento acontece em até duas horas.
            '7' => 'Depósito em conta'      // o comprador optou por fazer um depósito na conta corrente do PagSeguro. Ele precisará ir até uma agência bancária, fazer o depósito, guardar o comprovante e retornar ao PagSeguro para informar os dados do pagamento. A transação será confirmada somente após a finalização deste processo, que pode levar de 2 a 13 dias úteis.
        ];
        return $paymentsMethods[$method];
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getDateRefreshStatusAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function changeStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->save();
    }
}
