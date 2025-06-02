<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industri;

class IndustriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');

        $industriList = Industri::query()
            ->where('nama', 'like', '%' . $search . '%')
            ->orWhere('bidang_usaha', 'like', '%' . $search . '%')
            ->orWhere('alamat', 'like', '%' . $search . '%')
            ->get();

        return response()->json($industriList);
    }
    public function show($id)
    {
        $industri = Industri::findOrFail($id);
        return response()->json($industri);
    }
}
