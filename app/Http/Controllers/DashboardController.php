<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\KelolaKosans;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        Auth::user();
        if (Auth::user()->role == "Admin") {
            $totalKosan = KelolaKosans::count();
            $pemilikCount = User::where('role', 'Pemilik')->count();
            $penghuniCount = User::where('role', 'Penghuni')->count();
            $transaksiCount = Transaksi::count();

            return view('dashboard.index', compact('totalKosan', 'pemilikCount', 'penghuniCount', 'transaksiCount'));
        }
    }

    public function manajemenuser()
    {
        $users = User::whereIn("role", ["Admin", "Pemilik", "Penghuni"])->get();

        return view("dashboard.manajemenuser", compact('users'));
    }

    public function facilities()
    {
        $fasilitas = KelolaKosans::where("fasilitas", "!=", null)->get();

        return view("dashboard.fasilitas", compact('fasilitas'));
    }
    public function kelolakosan()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors("Silakan login terlebih dahulu.");
        }

        if ($user->role == "Admin") {
            $kosan = KelolaKosans::all();
        } else {
            $kosan = KelolaKosans::where("email", $user->email)->get();
        }
        return view("dashboard.kelolakosan", compact('kosan'));
    }
    public function newKosan(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'kosan' => 'required|string|max:255',
            'harga_kosan' => 'required|integer',
            'kamar' => 'required|integer',
            'pembayaran' => 'required|string',
            'fasilitas' => 'nullable|string',
            'tanggal_pembayaran' => 'required|date',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'link_map' => 'nullable|string',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'error' => 'User not authenticated',
                'message' => 'Silakan login terlebih dahulu.'
            ], 401); // 401 Unauthorized
        }

        // Upload file gambar jika ada
        $uploadedFiles = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $key => $file) {
                $uploadedFiles[] = $file->store('uploads/kosan', 'public');
            }
        }

        // Coba menyimpan data ke database
        try {
            $kosan = KelolaKosans::create([
                'nama_kosan' => $validatedData['kosan'],
                'harga' => $validatedData['harga_kosan'],
                'kamar' => $validatedData['kamar'],
                'diskon' => 0,
                'nomer_whatsapp' => '0',
                'per' => $validatedData['pembayaran'],
                'fasilitas' => $validatedData['fasilitas'],
                'tanggal' => $validatedData['tanggal_pembayaran'],
                'deskripsi' => $validatedData['deskripsi'] ? $validatedData['deskripsi'] : "tidak ada",
                'lokasi' => $validatedData['lokasi'],
                'map' => $validatedData['link_map'],
                'upload_file' => $uploadedFiles[0] ?? "tidak ada",      // Gambar pertama
                'upload_file_2' => $uploadedFiles[1] ?? "tidak ada",    // Gambar kedua
                'upload_file_3' => $uploadedFiles[2] ?? "tidak ada",    // Gambar ketiga
                'email' => $user->email,
            ]);

            // Jika berhasil, kembalikan response JSON
            return response()->json([
                'success' => true,
                'message' => 'Kosan berhasil ditambahkan.',
                'data' => $kosan
            ], 201); // 201 Created
        } catch (\Exception $e) {
            // Jika terjadi error saat menyimpan, kembalikan response JSON dengan pesan error
            return response()->json([
                'error' => 'Error saat menyimpan data kosan',
                'message' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    public function transaksi()
    {
        $transaksi = Transaksi::all(); // Ambil semua transaksi
        return view('dashboard.transaksi', compact('transaksi'));
    }
}
