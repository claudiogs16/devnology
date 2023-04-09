<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {


        try {
            $product = array();

            $promise = Http::async()->get('http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/brazilian_provider');
            $fornecedorBrazilian = json_decode($promise->wait());

            for ($i = 0; $i < count($fornecedorBrazilian); $i++) {
                $p = new Product(intval($fornecedorBrazilian[$i]->id), $fornecedorBrazilian[$i]->nome, $fornecedorBrazilian[$i]->descricao, floatval($fornecedorBrazilian[$i]->preco));
                $p->setSupplierID(1);
                $p->setCategory($fornecedorBrazilian[$i]->categoria);
                $p->setDepartment($fornecedorBrazilian[$i]->departamento);
                $p->setMaterial($fornecedorBrazilian[$i]->material);
                $p->setImages(stripslashes($fornecedorBrazilian[$i]->imagem));

                $product[] = $p;
            }

            $promise = Http::async()->get('http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/european_provider');
            $fornecedorEuropean = json_decode($promise->wait());


            for ($i = 0; $i < count($fornecedorEuropean); $i++) {
                $p = new Product(intval($fornecedorEuropean[$i]->id), $fornecedorEuropean[$i]->name, $fornecedorEuropean[$i]->description, floatval($fornecedorEuropean[$i]->price));
                $p->setSupplierID(2);
                $p->setHasDiscount($fornecedorEuropean[$i]->hasDiscount);
                $p->setDiscountValue($fornecedorEuropean[$i]->discountValue);

                for ($index = 0; $index < count($fornecedorEuropean[$i]->gallery); $index++) {
                    $p->setImages(stripslashes($fornecedorEuropean[$i]->gallery[$index]));
                }

                $p->setDetails($fornecedorEuropean[$i]->details);

                $product[] = $p;
            }


            // return json_encode($product);
            return response()->json($product);
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function show($supplierID, $id)
    {

        switch ($supplierID) {
            case 1:
                $promise = Http::async()->get('http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/brazilian_provider/' . $id);
                $fornecedorBrazilian = json_decode($promise->wait());

                if ($fornecedorBrazilian) {
                    $p = new Product(intval($fornecedorBrazilian->id), $fornecedorBrazilian->nome, $fornecedorBrazilian->descricao, floatval($fornecedorBrazilian->preco));
                    $p->setSupplierID(1);
                    $p->setCategory($fornecedorBrazilian->categoria);
                    $p->setDepartment($fornecedorBrazilian->departamento);
                    $p->setMaterial($fornecedorBrazilian->material);
                    $p->setImages($fornecedorBrazilian->imagem);
                    return response()->json($p);
                } else {
                    return [];
                }

            case 2:
                $promise = Http::async()->get('http://616d6bdb6dacbb001794ca17.mockapi.io/devnology/european_provider/' . $id);
                $fornecedorEuropean = json_decode($promise->wait());

                if ($fornecedorEuropean) {
                    $p = new Product(intval($fornecedorEuropean->id), $fornecedorEuropean->name, $fornecedorEuropean->description, floatval($fornecedorEuropean->price));
                    $p->setSupplierID(2);
                    $p->setHasDiscount($fornecedorEuropean->hasDiscount);
                    $p->setDiscountValue($fornecedorEuropean->discountValue);

                    for ($index = 0; $index < count($fornecedorEuropean->gallery); $index++) {
                        $p->setImages($fornecedorEuropean->gallery[$index]);
                    }

                    $p->setDetails($fornecedorEuropean->details);

                    // return json_encode($p);
                    return response()->json($p);
                } else {
                    return [];
                }


            default:
                return "Fornecedor não foi encontrado!!";
        }
    }
}
