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
}
