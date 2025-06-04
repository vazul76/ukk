<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');

        $guruList = Guru::query()
            ->where('nama', 'like', '%' . $search . '%')
            ->orWhere('nip', 'like', '%' . $search . '%')
            ->get();

        return response()->json($guruList);
    }

    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return response()->json($guru);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:gurus,nip',
            'email' => 'required|email|unique:gurus,email',
            'kontak' => 'required|string|max:20',
        ]);

        $guru = Guru::create($data);
        return response()->json($guru, 201);
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $data = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'nip' => 'sometimes|required|string|max:50|unique:gurus,nip,' . $guru->id,
            'email' => 'sometimes|required|email|unique:gurus,email,' . $guru->id,
            'kontak' => 'sometimes|required|string|max:20',
        ]);

        $guru->update($data);
        return response()->json($guru);
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return response()->json(['message' => 'Guru berhasil dihapus']);
    }
}
