<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');

        $siswaList = Siswa::query()
            ->where('nama', 'like', '%'.$search.'%')
            ->orWhere('nis', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->get();

        return response()->json($siswaList);
    }
    
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        return response()->json($siswa);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:20|unique:siswas,nis',
            'email' => 'required|email|unique:siswas,email',
            // Add other validation rules as needed
        ]);

        $siswa = Siswa::create($data);
        return response()->json($siswa, 201);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        
        $data = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'nis' => 'sometimes|required|string|max:20|unique:siswas,nis,'.$siswa->id,
            'email' => 'sometimes|required|email|unique:siswas,email,'.$siswa->id,
            // Add other validation rules as needed
        ]);

        $siswa->update($data);
        return response()->json($siswa);
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        return response()->json(null, 204);
    }
}
