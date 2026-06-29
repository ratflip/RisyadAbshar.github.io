<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; 
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function callback(Request $request)
{
    $serverKey = env('MIDTRANS_SERVER_KEY');

    $hashed = hash(
        "sha512",
        $request->order_id .
        $request->status_code .
        $request->gross_amount .
        $serverKey
    );

    if ($hashed !== $request->signature_key) {
        return response()->json([
            'message' => 'Invalid signature'
        ], 403);
    }

    $status = $request->transaction_status;
    $orderIdFromMidtrans = $request->order_id; // Hasil: "ORD-123"
    $paymentType = $request->payment_type;

    // 1. Hapus prefix 'ORD-' agar tersisa angkanya saja
    $realOrderId = str_replace('ORD-', '', $orderIdFromMidtrans); // Hasil: "123"

    // 2. Cari berdasarkan ID asli
    $order = Order::find($realOrderId);

    if (!$order) {
        Log::error('Order callback tidak ditemukan untuk ID: ' . $orderIdFromMidtrans);
        return response()->json([
            'message' => 'Order tidak ditemukan'
        ], 404);
    }

    if ($status == 'settlement' || $status == 'capture') {

        $order->update([
            'status' => 'success',
            'metode_pembayaran' => $paymentType
        ]);

    } elseif ($status == 'pending') {

        $order->update([
            'status' => 'pending'
        ]);

    } elseif (
        $status == 'deny' ||
        $status == 'expire' ||
        $status == 'cancel'
    ) {

        $order->update([
            'status' => 'failed'
        ]);
    }

    return response()->json([
        'status' => 'OK'
    ], 200);
}
}