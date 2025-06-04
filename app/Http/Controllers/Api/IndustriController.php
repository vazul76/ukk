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

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'kontak' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $industri = Industri::create($request->all());

        return response()->json($industri, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bidang_usaha' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'kontak' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $industri = Industri::findOrFail($id);
        $industri->update($request->all());

        return response()->json($industri);
    }

    public function destroy($id)
    {
        $industri = Industri::findOrFail($id);
        $industri->delete();

        return response()->json(['message' => 'Data industri berhasil dihapus']);
    }
}
