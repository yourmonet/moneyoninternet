<?php

namespace App\Http\Controllers\Bendahara;

use App\Http\Controllers\Controller;
use App\Models\PengajuanDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanDanaController extends Controller
{
    /**
     * Display a listing of all fund requests.
     */
    public function index(Request $request)
    {
        $query = PengajuanDana::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhere('jenis_pengajuan', 'like', "%{$search}%");
        }

        $pengajuans = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('bendahara.pengajuan-dana.index', compact('pengajuans'));
    }

    /**
     * Display the specified fund request details.
     */
    public function show($id)
    {
        $pengajuan = PengajuanDana::with('user')->findOrFail($id);
        return view('bendahara.pengajuan-dana.show', compact('pengajuan'));
    }

    /**
     * Process (approve/reject) the specified fund request.
     */
    public function proses(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:disetujui,ditolak'],
            'catatan_pengurus' => ['nullable', 'string', 'max:1000'],
        ], [
            'status.required' => 'Status persetujuan wajib ditentukan.',
            'status.in' => 'Status persetujuan tidak valid.',
            'catatan_pengurus.max' => 'Catatan maksimal 1000 karakter.',
        ]);

        $pengajuan = PengajuanDana::findOrFail($id);
        $pengajuan->update([
            'status' => $request->status,
            'catatan_pengurus' => $request->catatan_pengurus,
        ]);

        $statusText = $request->status === 'disetujui' ? 'disetujui' : 'ditolak';

        return redirect()->route('bendahara.pengajuan-dana.index')
            ->with('success', "Pengajuan dana milik {$pengajuan->user->name} berhasil {$statusText}.");
    }
}
