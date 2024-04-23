<?php

namespace App\Http\Controllers;

use App\Models\SparepartsDevice;
use Illuminate\Http\Request;

class SparepartsDeviceController extends Controller
{
    public function index()
    {
        // Get spare parts devices from the database ordered by the latest
        $sparepartsDevices = SparepartsDevice::latest()->pluck('name');

        // Return JSON response with the device names
        return response()->json(['message' => 'Data ditemukan', 'status' => true, 'data' => $sparepartsDevices]);
    }
}
