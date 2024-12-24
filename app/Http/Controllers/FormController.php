<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\KelolaKosans;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FormController extends Controller
{
    // Method for displaying the login form
    public function login()
    {
        $artist = Artist::all();
        return view('login', compact('artist'));
    }

    public function formLogin(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'role' => 'required|string',  // Validasi role yang diizinkan
        ]);

        // Cari pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Memeriksa apakah pengguna ditemukan, password cocok, dan role sesuai
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        if (Hash::check($request->password, $user->password) && $user->role === $request->role) {
            // Login pengguna
            Auth::login($user);
            return redirect()->route('dashboard.kelolakosan'); // Ganti dengan route yang sesuai
        } else {
            // Jika password atau role salah
            return redirect()->back()->withErrors(['email' => 'Email, password, atau role salah. ' . $request->role]);
        }
    }



    // Method for displaying the register form
    public function register()
    {
        $artist = Artist::all();
        return view('register', compact('artist'));
    }

    // Method to handle the registration form submission
    public function formRegister(Request $request)
    {
        // Validation rules with custom error messages
        $messages = [
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email harus berupa email yang valid',
            'email.unique' => 'Email sudah digunakan',
            'email.max' => 'Email maksimal 255 karakter',
            'number.required' => 'Nomor HP harus diisi',
            'number.numeric' => 'Nomor HP harus berupa angka',
            'number.min' => 'Nomor HP minimal 10 digit',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sama',
            'role.required' => 'Role harus diisi',
            'role.in' => 'Role harus berupa Admin, Pemilik, atau Penghuni',
        ];

        // Validating the form data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'number' => ['required', 'string', 'min:12'],
            'password' => ['required', 'min:8', 'confirmed'],  // Automatically checks password_confirmation
            'role' => ['required', 'string'],
        ], $messages);

        $checkEmail = User::where('email', $request->email)->first();
        if ($checkEmail) {
            return back()->withErrors(['email' => 'Email sudah digunakan']);
        } else {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->email_verified_at = now();
            $user->remember_token = Str::random(10);
            $user->number = $request->input('number');
            $user->password = bcrypt($request->input('password'));
            $user->role = $request->input('role'); // Pastikan nilai role diambil
            $user->save();

            if ($user) {
                return redirect('/login');
            }
        }
    }

    public function store(Request $request)
    {
        // Validasi form input
        $validated = $request->validate([
            'kosan' => 'required|string|max:255',
            'harga_kosan' => 'required|string',
            'kamar' => 'required|integer',
            'pembayaran' => 'required|string',
            'fasilitas' => 'nullable|string',
            'tanggal_pembayaran' => 'required|date',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'link_map' => 'nullable|string',
            'category' => 'required|string',
            'file.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Simpan data Kosan
        $kosan = new KelolaKosans();
        $kosan->nama_kosan = $validated['kosan'];
        $kosan->harga = $validated['harga_kosan'];
        $kosan->kamar = $validated['kamar'];
        $kosan->pembayaran = $validated['pembayaran'];
        $kosan->fasilitas = $validated['fasilitas'];
        $kosan->tanggal_pembayaran = $validated['tanggal_pembayaran'];
        $kosan->deskripsi = $validated['deskripsi'];
        $kosan->lokasi = $validated['lokasi'];
        $kosan->map = $validated['link_map'];
        $kosan->category = $validated['category'];
        $kosan->email = Auth::user()->email;
        // Upload file gambar
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $uploadedPaths = []; // Array untuk menyimpan path file yang diupload

            foreach ($files as $file) {
                $path = $file->store('uploads', 'public'); // Simpan file di folder 'public/uploads'
                $uploadedPaths[] = $path; // Tambahkan path ke array
            }

            // Simpan paths dalam format JSON ke atribut 'upload_file'
            $kosan->upload_file = json_encode($uploadedPaths);
        } else {
            $kosan->upload_file = json_encode([]); // Jika tidak ada file, simpan array kosong
        }

        $kosan->save();

        $kosan->save();



        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.kelolakosan')->with('success', 'Kosan berhasil ditambahkan!');
    }

    public function remove($id)
    {
        $kosan = KelolaKosans::find($id);
        if ($kosan) {
            $kosan->delete();
            return redirect()->route('dashboard.kelolakosan')->with('success', 'Kosan berhasil dihapus!');
        } else {
            return redirect()->route('dashboard.kelolakosan')->withErrors('Kosan tidak ditemukan atau sudah dihapus sebelumnya!');
        }
    }

    public function edit($id)
    {
        $kosan = KelolaKosans::findOrFail($id);

        return view('dashboard.edit', compact('kosan'));
    }

    // KosanController.php
    public function getKosan($id)
    {
        $kosan = KelolaKosans::find($id);
        return response()->json($kosan);
    }


    public function removeUser($id)
    {
        try {
            // Cari user berdasarkan ID
            $user = User::findOrFail($id);

            // Hapus user
            $user->delete();

            // Redirect kembali ke halaman manajemen user dengan pesan sukses
            return redirect()->route('manajemenuser')->with('success', 'User berhasil dihapus.');
        } catch (ModelNotFoundException $e) {
            // Jika user tidak ditemukan
            return redirect()->route('manajemenuser')->with('error', 'User tidak ditemukan.');
        }
    }


    public function editkosan(Request $request)
    {
        $kosan = KelolaKosans::find($request->id);
        if ($kosan) {
            // Make sure that the input fields are not empty
            $kosan->nama_kosan = $request->input('name'); // Ensure the 'name' field is sent from the form
            $kosan->harga = $request->input('harga');
            $kosan->kamar = $request->input('kamar');
            $kosan->pembayaran = $request->input('pembayaran');
            $kosan->fasilitas = $request->input('fasilitas');
            $kosan->tanggal_pembayaran = $request->input('tanggal_pembayaran');
            $kosan->deskripsi = $request->input('deskripsi');
            $kosan->lokasi = $request->input('lokasi');
            $kosan->map = $request->input('link_map');
            $kosan->category = $request->input('category');

            // Save the updated kosan
            $kosan->save();

            return redirect()->route('dashboard.kelolakosan')->with('success', 'Kosan berhasil diubah!');
        } else {
            return redirect()->route('dashboard.kelolakosan')->withErrors('Kosan tidak ditemukan atau sudah dihapus sebelumnya!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    public function kosan()
    {
        return $this->belongsTo(KelolaKosans::class, 'id_kosan');
    }
    


    public function pembayaran()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $transaksi = Transaksi::with('kosan') // Load data kosan melalui relasi
            ->where('user_id', $user->id)
            ->get();

        return view('dashboard.pembayaran', compact('transaksi'));
    }



    public function formPembayaran(Request $req)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $req->validate([
            'id_kosan' => 'required|integer',
            'name' => 'required',
            'bank' => 'required|string',
            'harga' => 'required',
            'tanggal' => 'required',
        ]);

        $kosan = KelolaKosans::find($req->id_kosan);
        $name = $kosan->nama_kosan;
        $harga = $kosan->harga;

        $user = User::where('email', Auth::user()->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $transaksi = new Transaksi();
        $transaksi->id_kosan = $req->id_kosan;
        $transaksi->code = Str::random(6);
        $transaksi->email = $user->email;
        $transaksi->nama = $user->name;
        $transaksi->nama_kosan = $name;
        $transaksi->bank = $req->bank;
        $transaksi->total = $harga;
        $transaksi->tanggal = $req->tanggal;
        $transaksi->user_id = $user->id;
        $transaksi->status = 'Pending';
        $transaksi->save();

        return redirect()->route('dashboard.transaksi')->with('success', 'Pembayaran berhasil diinputkan!');
    }

    public function removeTransaksi($id)
    {
        $transaksi = Transaksi::find($id);
        if ($transaksi) {
            $transaksi->delete();
            return redirect()->route('dashboard.transaksi')->with('success', 'Transaksi berhasil dihapus!');
        } else {
            return redirect()->route('dashboard.transaksi')->withErrors('Transaksi tidak ditemukan atau sudah dihapus sebelumnya!');
        }
    }

    public function markAsPaid(Request $request){
        $transaksi = Transaksi::find($request->id);
        if ($transaksi) {
            $transaksi->status = 'Paid';
            $transaksi->save();
            return redirect()->route('dashboard.transaksi')->with('success', 'Transaksi berhasil diperbarui!');
        } else {
            return redirect()->route('dashboard.transaksi')->withErrors('Transaksi tidak ditemukan atau sudah dihapus sebelumnya!');
        }
    }
}
