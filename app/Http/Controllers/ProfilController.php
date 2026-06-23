<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfilRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function edit()
    {
        return view('profil.edit');
    }

    public function update(UpdateProfilRequest $request)
    {
        $user = auth()->user();
        
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            // Hapus file avatar lama jika masih berbentuk file lokal
            if ($user->avatar && !str_starts_with($user->avatar, 'data:image')) {
                $disk = config('filesystems.default');
                if (Storage::disk($disk)->exists($user->avatar)) {
                    Storage::disk($disk)->delete($user->avatar);
                }
            }

            // Simpan gambar sebagai Base64
            $file = $request->file('avatar');
            $image = file_get_contents($file->getRealPath());
            $base64 = base64_encode($image);
            $mime = $file->getClientMimeType();
            
            $user->avatar = 'data:' . $mime . ';base64,' . $base64;
        }

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
