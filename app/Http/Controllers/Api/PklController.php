<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pkl;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class PklController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');

        $pkls = Pkl::with(['siswa', 'industri', 'guru'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                })->orWhereHas('industri', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                });
            })
            ->latest()
            ->get();

        return response()->json($pkls);
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ]);

        DB::beginTransaction();

        try {
            $siswa = Siswa::findOrFail($request->siswa_id);

            if ($siswa->status_lapor_pkl) {
                return response()->json(['error' => 'Siswa sudah melapor PKL'], 400);
            }

            $pkl = Pkl::create($request->all());
            $siswa->update(['status_lapor_pkl' => 1]);

            DB::commit();

            return response()->json($pkl, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan'], 500);
        }
    }

    public function show($id)
    {
        $pkl = Pkl::with(['siswa', 'industri', 'guru'])->findOrFail($id);
        return response()->json($pkl);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'industri_id' => 'required|exists:industris,id',
            'guru_id' => 'required|exists:gurus,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ]);

        $pkl = Pkl::findOrFail($id);
        $pkl->update($request->all());

        return response()->json($pkl);
    }

    public function destroy($id)
    {
        $pkl = Pkl::findOrFail($id);
        $pkl->delete();

        return response()->json(['message' => 'Data PKL berhasil dihapus']);
    }
}
