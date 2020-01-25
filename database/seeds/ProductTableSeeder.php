<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
        'name' => 'Nome '.uniqid(date('YmdHis')),
        'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
        'price' => 10.6,
        'image' => 'filme1.jpg'
        ]);
        Product::create([
            'name' => 'Nome '.uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
            'price' => 11.1,
            'image' => 'filme2.jpg'
        ]);
        Product::create([
            'name' => 'Nome '.uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
            'price' => 12.5,
            'image' => 'filme3.jpg'
        ]);
        Product::create([
            'name' => 'Nome '.uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
            'price' => 10.6,
            'image' => 'filme1.jpg'
        ]);
        Product::create([
            'name' => 'Nome '.uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
            'price' => 11.1,
            'image' => 'filme2.jpg'
        ]);
        Product::create([
            'name' => 'Nome '.uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
            'price' => 12.5,
            'image' => 'filme3.jpg'
        ]);
        Product::create([
            'name' => 'Nome '.uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
            'price' => 10.6,
            'image' => 'filme1.jpg'
        ]);
        Product::create([
            'name' => 'Nome '.uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
            'price' => 11.1,
            'image' => 'filme2.jpg'
        ]);
        Product::create([
            'name' => 'Nome '.uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
            'price' => 12.5,
            'image' => 'filme3.jpg'
        ]);
        Product::create([
            'name' => 'Nome '.uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
            'price' => 10.6,
            'image' => 'filme1.jpg'
        ]);
        Product::create([
            'name' => 'Nome '.uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
            'price' => 11.1,
            'image' => 'filme2.jpg'
        ]);
        Product::create([
            'name' => 'Nome '.uniqid(date('YmdHis')),
            'description' => 'Descrição do Produto '.uniqid(date('YmdHis')),
            'price' => 12.5,
            'image' => 'filme3.jpg'
        ]);
    }
}
