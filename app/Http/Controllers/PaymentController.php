<?php

namespace App\Http\Controllers;

use App\Models\KelolaKosans;
use App\Models\Nota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment(Request $req)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan login terlebih dahulu.');
        }

        $validatedData = $req->validate([
            'id' => 'required|integer',
            'bank' => 'required|string|in:bca,bri,mandiri',
            'nama' => 'required|string',
            'tanggalMulai' => 'required|string'
        ], [
            'id.required' => 'ID kosan tidak boleh kosong.',
            'id.integer' => 'ID kosan harus berupa angka.',
            'id.exists' => 'Kosan tidak ditemukan.',
            'bank.required' => 'Bank harus dipilih.',
            'bank.in' => 'Bank yang dipilih tidak valid.',
            'nama.required' => 'Nama wajib diisi.'
        ]);

        $user = Auth::user();
        $hari = now()->format('l');
        $k = base64_encode("{$validatedData['id']}&{$user->email}&{$hari}&{$validatedData['bank']}&{$validatedData['tanggalMulai']}&{$validatedData['nama']}");

        // return response()->json([
        //     'id' => $validatedData['id']
        // ]);
        return redirect()->route('nota', ['k' => $k]);
    }

    public function nota(Request $request)
    {
        $k = $request->query('k');
        $decodedString = base64_decode($k);

        list($id, $email, $hari, $bank_, $tanggal, $nama) = explode("&", $decodedString);

        $bankNumbers = [
            'bca' => '01123132344',
            'bri' => '20380202012',
            'mandiri' => '023092093029'
        ];
        
        if (!array_key_exists($bank_, $bankNumbers)) {
            return redirect()->back()->withErrors('Bank tidak valid.');
        }

        $kosan = KelolaKosans::find($id);
        if (!$kosan) {
            return redirect()->back()->withErrors('Kosan tidak ditemukan.');
        }

        $user = User::where("email", $email)->first();
        if ($user) {
            $harga = 0;
            if ($kosan->diskon > 0) {
                // Jika ada diskon (lebih besar dari 0), aplikasikan diskon dalam format desimal
                $harga = $kosan->harga - ($kosan->harga * $kosan->diskon);
            } else {
                // Jika tidak ada diskon, gunakan harga normal
                $harga = $kosan->harga;
            }
            
            
            $nota = new Nota();
            $nota->nama = $nama;
            $nota->bank = $bank_;
            $nota->email = $email;
            $nota->total = $harga;
            $nota->transaksi = str($bankNumbers[$bank_]);
            $nota->tanggal = str($tanggal);
            $nota->code = 'KOS-' . time() . '-' . $user->id;
            $nota->save();

            return response()->json([
                'id' => $id,
                'email' => $email,
                'hari' => $hari,
                'bank' => $bankNumbers[$bank_],
                'tanggal' => $nota->tanggal,
                'code' => $nota->code,
                'total' => $nota->total
            ]);
        }

        return redirect()->back()->withErrors('Pengguna tidak ditemukan.');
    }
}
