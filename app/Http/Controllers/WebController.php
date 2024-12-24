<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Bank;
use App\Models\KelolaKosans;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class WebController extends Controller
{
    public function home()
    {
        $kost = KelolaKosans::all();
        return view('home')->with('kosan', $kost);
    }


    

    public function formLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'role' => 'required|string|in:owner,user',
        ]);

        // Cek autentikasi pengguna
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Validasi peran
            if ($user->role !== $request->role) {
                Auth::logout();
                return redirect()->back()->withErrors(['role' => 'Peran tidak sesuai dengan akun yang digunakan.']);
            }

            // Menyimpan cookie untuk role 'owner'
            if ($user->role === 'owner') {
                Cookie::queue('email', $request->email, 120); // Cookie berlaku 2 jam
                return redirect()->route('dashboard.kelolakosan');
            } else {
                return redirect()->intended('/');
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'Email atau password salah.']);
        }
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'nullable|boolean',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek apakah email dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            // Jika 'remember' diaktifkan, lakukan login dengan pengingat
            Auth::login($user, $request->remember);

            // Menyimpan cookie untuk role 'owner' jika ada
            if ($user->role === 'owner') {
                Cookie::queue('email', $request->email, 120); // Cookie berlaku 2 jam
            }

            return redirect()->intended('/dashboard/kelolakosan');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function register()
    {
        return view('register');
    }

    

    public function viewkosan(Request $req)
    {
        Auth::user();
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $kosan = KelolaKosans::find( $req->id);
        $banks = Bank::all();
        if($kosan){
            return view('open', compact('banks', 'kosan'));
        }
    }
}
