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


   public function createOrder(Request $request)
   {
       try {
           $order = Orders::create([
               'USUARIO_ID' => 25,
               'STATUS_ID' => 1,
               'PEDIDO_DATA' => date('Y-m-d H:i:s')
           ]);

           $orderItens = OrdersItens::create([
               'PEDIDO_ID' => $order->PEDIDO_ID,
               'PRODUTO_ID' => $request->PRODUTO_ID,
               'ITEM_QTD' => $request->ITEM_QTD,

                'ITEM_PRECO' => $request->ITEM_PRECO

           ]);

           return response()->json([
               'status' => 200,
               'message' => 'Pedido criado com sucesso',
               'data' => [
                   'Pedido: ' => $order,
                   'Itens do Pedido:' => $orderItens

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
 

   public function finishOrder(){
         try {
              $order = Orders::where('PEDIDO_ID', 1)->first();
    
              if(!$order){
                return response()->json([
                     'status' => 200,
                     'message' => 'Pedido não encontrado',
                     'data' => []
                ], 200);
              }
    
              $order->update([
                'STATUS_ID' => 2,
                'PEDIDO_DATA' => date('Y-m-d H:i:s')
              ]);
    
              return response()->json([
                'status' => 200,
                'message' => 'Compra finalizada com sucesso',
                'data' => [
                     'Pedido: ' => $order
                ]
              ], 200);
         } catch (\Throwable $th) {
              return response()->json([
                'status' => 500,
                'message' => 'Erro ao finalizar pedido '.$th,
                'data' => []
              ], 500);
         }
   }
}
