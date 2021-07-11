<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Teknisi, Order};
use App\Http\Resources\{OrderResource, OrdersResource};

class OrderController extends Controller
{
    public function getOrder(Teknisi $teknisi){
        $orders = $teknisi->orders->where('status', '5');
        return response()->json([
            'message' => 'success',
            'orders' => OrdersResource::collection($orders)
        ]);
    }

    public function getDetailOrder(Order $order){
        return new OrderResource($order);
    } 

    public function getOrderFinish(Teknisi $teknisi){
        $orders = $teknisi->orders->where('status', '7');
        return response()->json([
            'message' => 'success',
            'info' => 'Order Finish',
            'orders' => OrdersResource::collection($orders)
        ]);
    }

    public function getOrderPayment(Teknisi $teknisi){
        $orders = $teknisi->orders->where('status', '8');
        return response()->json([
            'message' => 'success',
            'info' => 'Order Payment',
            'orders' => OrdersResource::collection($orders)
        ]);
    }

    public function getOrderComplete(Teknisi $teknisi){
        $orders = $teknisi->orders->where('status', '9');
        return response()->json([
            'message' => 'success',
            'info' => 'Order Complete',
            'orders' => OrdersResource::collection($orders)
        ]);
    }

    // public function getOrderReport(Teknisi $teknisi){
    //     $orders = $teknisi->orders->where('status', '2');
    //     return response()->json([
    //         'message' => 'success',
    //         'orders' => $orders
    //     ]);
    // }
}
