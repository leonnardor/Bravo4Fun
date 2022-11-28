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
            $orders = Orders::where('USUARIO_ID', 25)->get();

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
                    'Pedidos: ' => $orders,
                    'Itens do Pedido:' => $ordersItens,
                    'Status do Pedido:' => $ordersStatus,
                    'Produtos:' => $products,
                    'Valor:' => 'R$'.$totalPrice,
                    'Valor final com desconto:' => 'R$'.$totalPriceWithDiscount
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao listar pedidos '.$th,
                'data' => []
            ], 500);
        }
    }

    public function addItensToOrder(Request $request)
    {
        try {
            $order = Orders::where('USUARIO_ID', 25)->get();
            $orderItens = new OrdersItens();
            $orderItens->PEDIDO_ID = $order[0]->PEDIDO_ID;
            $orderItens->PRODUTO_ID = $request->PRODUTO_ID;
            $orderItens->save();

            return response()->json([
                'status' => 200,
                'message' => 'Item adicionado ao pedido com sucesso',
                'data' => [
                    'Pedido: ' => $order,
                    'Itens do Pedido:' => $orderItens
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao adicionar item ao pedido ' ,
                'error' => $th,
                'data' => []
            ], 500);
        }
    }

    public function createOrder(Request $request)
    {
        try {
            $order = new Orders(); 
            $order->USUARIO_ID = 25;
            $order->STATUS_DESC = 'Aguardando Pagamento';
            $order->save();

              
            $orderItens = new OrdersItens();
            $orderItens->PEDIDO_ID = $order->PEDIDO_ID;
            $orderItens->PRODUTO_ID = $request->PRODUTO_ID;
            $orderItens->save();


            $orderStatus = new OrdersStatus();
            $orderStatus->PEDIDO_ID = $order->PEDIDO_ID;
            $orderStatus->STATUS_DESC = $order->STATUS_DESC;
            $orderStatus->save();

            return response()->json([
                'status' => 200,
                'message' => 'Pedido criado com sucesso',
                'data' => [
                    'Pedido: ' => $order,
                    'Itens do Pedido:' => $orderItens,
                    'Status do Pedido:' => $orderStatus
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao criar pedido '.$th,
                'data' => []
            ], 500);
        }
    }


    public function updateOrderStatus(Request $request)
    {
        try {
            $order = Orders::where('USUARIO_ID', 25)->get();
            $orderStatus = OrdersStatus::where('PEDIDO_ID', $order[0]->PEDIDO_ID)->get();

            $orderStatus[0]->STATUS_DESC = $request->STATUS_DESC;
            $orderStatus[0]->save();

            $orderItens = OrdersItens::where('PEDIDO_ID', $order[0]->PEDIDO_ID)->get();
            $orderItens[0]->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Compra finalizada com sucesso',
                'data' => [
                    'Pedido: ' => $order,
                    'Status do Pedido:' => $orderStatus
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Erro ao finalizar a compra '.$th,
                'data' => []
            ], 500);
        }
    }


    

   

    
}
