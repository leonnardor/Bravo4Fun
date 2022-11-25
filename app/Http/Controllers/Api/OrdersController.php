<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrdersItens;
use App\Models\OrdersStatus;
use App\Models\Products;

class OrdersController extends Controller
{
    public function getMyOrders()
    {
        try {
            $orders = Orders::where('USUARIO_ID', 24)->get();

            if($orders->isEmpty()){
                return response()->json([
                    'status' => 200,
                    'message' => 'Você não possui pedidos',
                    'data' => []
                ], 200);
            } 

            $ordersItens = OrdersItens::where('PEDIDO_ID', $orders[0]->PEDIDO_ID)->get();
            $ordersStatus = OrdersStatus::where('STATUS_DESC', $orders[0]->STATUS_DESC)->get();
            $products = Products::where('PRODUTO_ID', $ordersItens[0]->PRODUTO_ID)->get();

            $totalPrice = 0;
            $totalPriceWithDiscount = 0;
            foreach($products as $item){
                $totalPrice += $item->PRODUTO_PRECO;
                $totalPriceWithDiscount += $item->PRODUTO_DESCONTO;
            }

            $totalPrice = number_format($totalPrice, 2, '.', '');
            $totalPriceWithDiscount = number_format($totalPriceWithDiscount, 2, '.', '');

            return response()->json([
                'status' => 200,
                'message' => 'Pedidos listados com sucesso',
                'data' => [
                    'orders' => $orders,
                    'ordersItens' => $ordersItens,
                    'Order Status' => $ordersStatus,
                    'products' => $products,
                    'Value:' => 'R$'.$totalPrice,
                    'Value With Discount:' => 'R$'.$totalPriceWithDiscount
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao listar pedidos'.$th,
                'data' => []
            ], 500);
        }
    }
}
