<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Student;

class AdminAuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            if ($user->role !== 'admin') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun ini bukan akun admin. Silakan gunakan halaman login yang sesuai.',
                ])->withInput($request->except('password'));
            }

            $request->session()->regenerate();
            return redirect('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    public function dashboard(): View
    {
        $totalUsers = User::count();
        $totalBendahara = User::where('role', 'bendahara')->count();
        $totalPengurus = User::where('role', 'pengurus')->count();
        $totalAnggota = User::where('role', 'anggota')->count();

        // Riwayat Pendaftaran Akun (kecuali admin)
        $riwayatPendaftaran = User::where('role', '!=', 'admin')
                                  ->latest()
                                  ->take(5)
                                  ->get();

        return view('admin.dashboard', compact('totalUsers', 'totalBendahara', 'totalPengurus', 'totalAnggota', 'riwayatPendaftaran'));
    }

    public function manajemenBendahara(Request $request): View
    {
        $search = $request->input('search');
        $bendaharas = User::where('role', 'bendahara')
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->paginate(20)
            ->withQueryString();
        return view('admin.manajemen-bendahara', compact('bendaharas', 'search'));
    }

    public function storeBendahara(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'bendahara',
            'account_status' => 'active',
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.bendahara.index')->with('success', 'Akun Bendahara berhasil dibuat.');
    }

    public function destroyBendahara($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        if ($user->role === 'bendahara') {
            $user->delete();
            return redirect()->route('admin.bendahara.index')->with('success', 'Akun Bendahara berhasil dihapus.');
        }
        return redirect()->route('admin.bendahara.index')->with('error', 'Aksi tidak valid.');
    }

    public function manajemenPengurus(Request $request): View
    {
        // Only active pengurus
        $search = $request->input('search');
        $pengurus = User::where('role', 'pengurus')
                        ->where('account_status', 'active')
                        ->when($search, function ($query, $search) {
                            return $query->where(function($q) use ($search) {
                                $q->where('name', 'like', "%{$search}%")
                                  ->orWhere('email', 'like', "%{$search}%")
                                  ->orWhere('department', 'like', "%{$search}%");
                            });
                        })
                        ->paginate(20)
                        ->withQueryString();
        return view('admin.manajemen-pengurus', compact('pengurus', 'search'));
    }

    public function storePengurus(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'department' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'password' => Hash::make($request->password),
            'role' => 'pengurus',
            'account_status' => 'active', // Langsung aktif
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.pengurus.index')->with('success', 'Akun Pengurus berhasil dibuat.');
    }

    public function destroyPengurus($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        if ($user->role === 'pengurus') {
            $user->delete();
            return redirect()->route('admin.pengurus.index')->with('success', 'Akun Pengurus berhasil dihapus.');
        }
        return redirect()->route('admin.pengurus.index')->with('error', 'Aksi tidak valid.');
    }

    public function persetujuanAkun(): View
    {
        $waitingAccounts = User::whereIn('role', ['pengurus', 'anggota'])
                                ->where('account_status', 'waiting')
                                ->latest()
                                ->get();
        return view('admin.persetujuan-akun', compact('waitingAccounts'));
    }

    public function approveAkun($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        if (in_array($user->role, ['pengurus', 'anggota']) && $user->account_status === 'waiting') {
            $user->update(['account_status' => 'active']);
            return redirect()->route('admin.akun.persetujuan')->with('success', "Akun {$user->name} berhasil disetujui.");
        }
        return redirect()->route('admin.akun.persetujuan')->with('error', 'Aksi tidak valid.');
    }

    public function rejectAkun($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        if (in_array($user->role, ['pengurus', 'anggota']) && $user->account_status === 'waiting') {
            $user->update(['account_status' => 'rejected']);
            return redirect()->route('admin.akun.persetujuan')->with('success', "Pendaftaran akun {$user->name} ditolak.");
        }
        return redirect()->route('admin.akun.persetujuan')->with('error', 'Aksi tidak valid.');
    }

    public function manajemenAnggota(Request $request): View
    {
        $search = $request->input('search');
        $anggota = User::where('role', 'anggota')
                        ->where('account_status', 'active')
                        ->when($search, function ($query, $search) {
                            return $query->where(function($q) use ($search) {
                                $q->where('name', 'like', "%{$search}%")
                                  ->orWhere('email', 'like', "%{$search}%");
                            });
                        })
                        ->paginate(20)
                        ->withQueryString();
        // Ambil data dari tabel students untuk dropdown, di mana nama/nim belum digunakan
        $students = Student::all();
        
        return view('admin.manajemen-anggota', compact('anggota', 'students', 'search'));
    }

    public function storeAnggota(Request $request): RedirectResponse
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $student = Student::findOrFail($request->student_id);

        User::create([
            'name' => $student->name, // Ambil nama dari data students
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
            'account_status' => 'active', // Langsung aktif
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Akun Mahasiswa berhasil dibuat.');
    }

    public function destroyAnggota($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        if ($user->role === 'anggota') {
            $user->delete();
            return redirect()->route('admin.anggota.index')->with('success', 'Akun Mahasiswa berhasil dihapus.');
        }
        return redirect()->route('admin.anggota.index')->with('error', 'Aksi tidak valid.');
    }
}
