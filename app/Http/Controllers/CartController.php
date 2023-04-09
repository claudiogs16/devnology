<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{



    public function index($user_id)
    {
        $validator = Validator::make(['user_id' => $user_id], [
            'user_id' => 'required|integer|exists:users,id',
        ], [
            'exists' => 'O :attribute é invalido.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {

            // $user = User::with('carts')->find($user_id);

            $carts = User::find($user_id)->carts()->get();

            return response()->json($carts);
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function store(Request $req)
    {



        $validator = Validator::make($req->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'quantity' => 'required|integer',

        ], [
            'integer' => 'O campo :attribute deve ser um número inteiro.',
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O :attribute é invalido.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }




        try {
            $cart = Cart::where('product_id', $req->input('product_id'))->where('supplier_id', $req->input('supplier_id'))->where('user_id', $req->input('user_id'))->first();

            if ($cart) {
                $cart->quantity = intval($cart->quantity)  + intval($req->input('quantity'));
                $cart->save();
                return $cart->refresh();
            }


            $cart = new Cart();
            $cart->user_id = $req->input('user_id');
            $cart->product_id = $req->input('product_id');
            $cart->supplier_id = $req->input('supplier_id');
            $cart->quantity = $req->input('quantity');

            $cart->save();

            return $cart->refresh();
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|integer|exists:carts,id',
        ], [
            'exists' => 'O :attribute é invalido.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }



        try {
            $cart = Cart::find($id);

            if ($cart) {
                $cart->delete();
                return $cart->refresh();
            } else {
                return 'O item não foi encontrado';
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function clear($user_id)
    {
        $validator = Validator::make(['user_id' => $user_id], [
            'user_id' => 'required|integer|exists:users,id',
        ], [
            'exists' => 'O :attribute é invalido.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        try {
            // $carts = Cart::where('user_id', $user_id)->delete();

            // if($carts){
            //     return json_encode($carts);
            // }else{
            //     return 'Os itens não foram encontrados';
            // }

            $user = User::where('id', $user_id)->first();

            return $user;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}


// protected $fillable = [
//     'user_id',
//     'product_id',
//     'supplier_id',
//     'quantity',
// ];
