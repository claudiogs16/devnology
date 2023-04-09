<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Product;

class TestController extends Controller
{
    public function show()
    {
        return 'Teste com sucesso!!';
    }



    public function loadAPISupplier()
    {


        $product = array();





        $promise = Http::async()->get('http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/brazilian_provider');
        $fornecedorBrazilian = json_decode($promise->wait());



        for ($i = 0; $i < 3; $i++) {
            $s = new Product(intval($fornecedorBrazilian[$i]->id), $fornecedorBrazilian[$i]->nome, $fornecedorBrazilian[$i]->descricao, floatval($fornecedorBrazilian[$i]->preco));
            $s->setSupplierID(1);
            $s->setCategory($fornecedorBrazilian[$i]->categoria);
            $s->setDepartment($fornecedorBrazilian[$i]->departamento);
            $s->setMaterial($fornecedorBrazilian[$i]->material);
            $s->setImages($fornecedorBrazilian[$i]->imagem);
            $product[] = $s;
        }

        $promise = Http::async()->get('http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/european_provider');
        $fornecedorEuropean = json_decode($promise->wait());



        return json_encode($fornecedorEuropean);
    }
}
