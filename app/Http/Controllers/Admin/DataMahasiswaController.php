<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class DataMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $students = Student::latest()
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('nim', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%")
                      ->orWhere('angkatan', 'like', "%{$search}%");
                });
            })
            ->paginate(20)
            ->withQueryString();
        return view('admin.manajemen-mahasiswa', compact('students', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:50|unique:students,nim',
            'name' => 'required|string|max:255',
            'angkatan' => 'nullable|string|max:4',
        ]);

        Student::create([
            'nim' => $request->nim,
            'name' => $request->name,
            'angkatan' => $request->angkatan,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        $request->validate([
            'nim' => 'required|string|max:50|unique:students,nim,' . $student->id,
            'name' => 'required|string|max:255',
            'angkatan' => 'nullable|string|max:4',
        ]);

        $student->update([
            'nim' => $request->nim,
            'name' => $request->name,
            'angkatan' => $request->angkatan,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus.');
    }
}
