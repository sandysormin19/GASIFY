<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function notification(Request $request)
    {
        try {
            $notif = new Notification();

            $orderNumber = $notif->order_id;
            $transactionStatus = $notif->transaction_status;
            $fraudStatus = $notif->fraud_status ?? null;

            $order = Order::where('order_number', $orderNumber)->first();

            if (!$order) {
                return response()->json(['message' => 'Order tidak ditemukan'], 404);
            }

            if ($transactionStatus === 'capture') {
                if ($fraudStatus === 'challenge') {
                    $order->payment_status = 'challenge';
                } else {
                    $order->payment_status = 'paid';
                }
            } elseif ($transactionStatus === 'settlement') {
                $order->payment_status = 'paid';
            } elseif ($transactionStatus === 'pending') {
                $order->payment_status = 'pending';
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $order->payment_status = 'failed';
            }

            $order->save();

            return response()->json(['message' => 'Status pembayaran diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memproses notifikasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
