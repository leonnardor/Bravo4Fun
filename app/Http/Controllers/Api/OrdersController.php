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
            $ordersStatus = OrdersStatus::where('STATUS_ID', $orders[0]->STATUS_ID)->get();

            return response()->json([
                'status' => 200,
                'message' => 'Pedidos listados com sucesso',
                'data' => [
                    'Pedidos: ' => $orders,
                    'Status do Pedido:' => $ordersStatus,
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



   public function getOrder($id){
         try {
              $orders = Orders::where('PEDIDO_ID', $id)->get();
              
    
              if($orders->isEmpty()){
                return response()->json([
                     'status' => 200,
                     'message' => 'Você não possui pedidos',
                     'data' => []
                ], 200);
              } 
    
              $ordersItens = OrdersItens::where('PEDIDO_ID', $orders[0]->PEDIDO_ID)->get();
              $ordersStatus = OrdersStatus::where('STATUS_ID', $orders[0]->STATUS_ID)->get() ;
              $products = Products::where('PRODUTO_ID', $ordersItens[0]->PRODUTO_ID)->get();
              $productsName = [];
              $productsPrice = [];
              $productsQuantity = [];
              foreach($ordersItens as $item){
                $productsName[] = $item->products->PRODUTO_NOME;
                $productsPrice[] = $item->products->PRODUTO_PRECO;
                $productsQuantity[] = $item->ITEM_QTD;
              }
    
              $totalOrder = 0;
              $totalProducts = 0;
              foreach($ordersItens as $item){
                $totalOrder += $item->ITEM_QTD * $item->products->PRODUTO_PRECO;
                $totalOrderWithDiscunt = $totalOrder - $orders[0]->PRODUTO_DESCONTO;
    
                $desconto = $orders[0]->PRODUTO_DESCONTO;
                $totalProducts += $item->ITEM_QTD;
              }
    
              return response()->json([
                'status' => 200,
                'message' => 'Pedidos listados com sucesso',
                'data' => [
                     'Pedidos: ' => $orders,
                     'Itens do Pedido:' => $ordersItens,
                     'Status do Pedido:' => $ordersStatus,
                     'Valor:' => 'R$'.$totalOrder,
    
                     'Valor final com desconto:' => 'R$'.$desconto,
                     'Quantidade de produtos:' => $totalProducts,
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
