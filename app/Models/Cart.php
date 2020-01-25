<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Session;

class Cart extends Model
{
    private $items = [];

    public function __construct()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            $this->items = $cart->items;
        }
    }


    public function add(Product $product)
    {
        if (isset($this->items[$product->id])) {
            $this->items[$product->id] = [
                'item' => $product,
                'qtd' => $this->items[$product->id]['qtd'] + 1,
            ];
        } else {
            $this->items[$product->id] = [
                'item' => $product,
                'qtd' => 1,
            ];
        }
    }

    public function remove(Product $product)
    {
        if (isset($this->items[$product->id]) && $this->items[$product->id]['qtd'] > 1)
            $this->items[$product->id] = [
                'item' => $product,
                'qtd' => $this->items[$product->id]['qtd'] - 1,
            ];
        elseif( isset($this->items[$product->id]) )
            unset($this->items[$product->id]);
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item)
        {
            $subTotal = $item['item']->price * $item['qtd'];
            $total += $subTotal;
        }
        return $total;
    }

    public function getTotalItems()
    {
        return count($this->items);
    }

    public function emptyCart()
    {
        if( Session::has('cart'))
            Session::forget('cart');
    }

}
