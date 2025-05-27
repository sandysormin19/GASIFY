<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CourierLocation;
use MongoDB\BSON\ObjectId;

class CourierLocationController extends Controller
{
    public function updateLocation(Request $request)
    {
        $request->validate([
            'courier_id' => 'required|numeric',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        CourierLocation::updateOrCreate(
            ['courier_id' => $request->courier_id],
            ['lat' => $request->lat, 'lng' => $request->lng]
        );

        return response()->json(['message' => 'Lokasi berhasil diperbarui']);
    }

    public function getLocationByOrder($orderId)
    {
        // Convert string ke ObjectId
        try {
            $objectId = new ObjectId($orderId);
        } catch (\Exception $e) {
            return response()->json(['message' => 'ID tidak valid'], 400);
        }

        $order = Order::where('_id', $objectId)->first();

        if (!$order || !isset($order->courier_id)) {
            return response()->json(['message' => 'Order atau courier_id tidak ditemukan'], 404);
        }

        $location = CourierLocation::where('courier_id', $order->courier_id)->first();

        if (!$location) {
            return response()->json(['message' => 'Lokasi kurir tidak ditemukan'], 404);
        }

        return response()->json([
            'lat' => floatval($location->lat),
            'lng' => floatval($location->lng),
        ]);
    }
}
