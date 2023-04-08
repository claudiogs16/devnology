<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Product;

class ProductController extends Controller
{
    public function showAllProduct(){


        $product = array();





        $promise = Http::async()->get('http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/brazilian_provider');
        $fornecedorBrazilian = json_decode($promise->wait());



        for ($i=0; $i < count($fornecedorBrazilian); $i++) {
            $p = new Product(intval($fornecedorBrazilian[$i]->id), $fornecedorBrazilian[$i]->nome, $fornecedorBrazilian[$i]->descricao, floatval($fornecedorBrazilian[$i]->preco));
            $p->setSupplierID(1);
            $p->setCategory($fornecedorBrazilian[$i]->categoria);
            $p->setDepartment($fornecedorBrazilian[$i]->departamento);
            $p->setMaterial($fornecedorBrazilian[$i]->material);
            $p->setImages($fornecedorBrazilian[$i]->imagem);
            $product[] = $p;
        }

        $promise = Http::async()->get('http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/european_provider');
        $fornecedorEuropean = json_decode($promise->wait());



        for ($i=0; $i < count($fornecedorEuropean); $i++) {
            $p = new Product(intval($fornecedorEuropean[$i]->id), $fornecedorEuropean[$i]->name, $fornecedorEuropean[$i]->description, floatval($fornecedorEuropean[$i]->price));
            $p->setSupplierID(2);
            $p->setHasDiscount($fornecedorEuropean[$i]->hasDiscount);
            $p->setDiscountValue($fornecedorEuropean[$i]->discountValue);

            for ($index=0; $index < count($fornecedorEuropean[$i]->gallery); $index++) {
                $p->setImages($fornecedorEuropean[$i]->gallery[$index]);
            }

            $p->setDetails($fornecedorEuropean[$i]->details);

            $product[] = $p;
        }


        return json_encode($product);

    }
}
