<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
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

            $order = Order::with('orderItems')->where('user_id', $user_id)->get();



            if (!$order)
                return [];

            return $order;
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function store(Request $req, $user_id)
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


        // return $orders = json_decode($req->getContent(), true);

        $validator = Validator::make($req->all(), [
            "orders" => 'required|array',
            'orders.*.product_id' => 'required|integer',
            'orders.*.supplier_id' => 'required|integer',
            'orders.*.name' => 'required|string',
            'orders.*.description' => 'required|string',
            'orders.*.category' => 'nullable|string',
            'orders.*.department' => 'nullable|string',
            'orders.*.material' => 'nullable|string',
            'orders.*.price' => 'required|integer',
            'orders.*.discountValue' => 'required|numeric',
            'orders.*.hasDiscount' => 'required|boolean',
            'orders.*.quantity' => 'required|integer|min:1',
            'orders.*.details' => 'nullable',
            'orders.*.image' => 'required|string',
        ], [
            'orders.required' => 'O campo :attribute é obrigatório.',
            'orders.array' => 'O campo :attribute deve ser um array.',

            'orders.*.required' => 'O campo :attribute é obrigatório.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser um texto.',
            'numeric' => 'O campo :attribute deve ser decimal.',
            'boolean' => 'O campo :attribute deve ser boolean.',
            'min' => 'O campo :attribute deve ser maior que :min.',
        ]);



        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }



        $newOrder = new Order;
        $newOrder->user_id = $user_id;


        $newOrder = Order::create([
            'user_id' => $user_id,
        ]);


        for ($i = 0; $i < count($req->orders); $i++) {
            $name = $req->orders[$i]['name'];

            $orderItem = new OrderItem;
            $orderItem->product_id = intval($req->orders[$i]['product_id']);
            $orderItem->supplier_id = intval($req->orders[$i]['supplier_id']);
            $orderItem->name = $req->orders[$i]['name'];

            $orderItem->price = $req->orders[$i]['price'];
            $orderItem->discountValue = $req->orders[$i]['discountValue'];
            $orderItem->hasDiscount = $req->orders[$i]['hasDiscount'];
            $orderItem->image = stripslashes($req->orders[$i]['image']);
            $orderItem->quantity = intval($req->orders[$i]['quantity']);

            if (isset($req->orders[$i]['description']))
                $orderItem->description = $req->orders[$i]['description'];
            if (isset($req->orders[$i]['category']))
                $orderItem->category = $req->orders[$i]['category'];
            if (isset($req->orders[$i]['department']))
                $orderItem->department = $req->orders[$i]['department'];
            if (isset($req->orders[$i]['material']))
                $orderItem->material = $req->orders[$i]['material'];


            if (isset($req->orders[$i]['details']))
                $orderItem->details = $req->orders[$i]['details'];




            $newOrder->orderItems()->save($orderItem);
        }


        $newOrder->save();

        return $newOrder;
    }
}
