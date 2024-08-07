<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\buktitransfer;
use App\Models\Cart;
use App\Models\User;
class buktitransferController extends Controller
{
    public function index($id, $user_id){
        $invoiceId = urldecode($id);
        $itemuser = User::findOrFail($user_id);
        $tf = buktitransfer::where('no_invoice', $invoiceId)->where('user_id', $itemuser->id)->first(); // Ubah dari get() ke first()
       
        $title = "Bukti Transfer";
        $itemorder = Cart::with('detail.produk')
                        ->where('user_id', $itemuser->id)
                        ->where('no_invoice', $invoiceId)
                        ->first();
        // return $itemorder;
        return view('buktitransfer.index', compact('itemuser', 'title', 'itemorder', 'tf'));

        // $post = Cart::where('no')
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required',
            'no_invoice' => 'required',
        ]);

        // Menyimpan file gambar bukti transfer
        $imageName = time() . '.' . $request->foto->extension();
        $request->foto->storeAs('buktitransfers', $imageName, 'public');

        // Membuat entri baru di tabel buktitransfer
        buktitransfer::create([
            'user_id' => $request->user_id,
            'foto' => $imageName,
            'no_invoice' => $request->no_invoice,
        ]);

        // Mengambil data order dan memperbarui status pembayaran
        $itemorder = Cart::with('detail.produk')
                        ->where('user_id', $request->user_id)
                        ->where('no_invoice', $request->no_invoice)
                        ->first();
                        
        if ($itemorder) {
            $itemorder->status_pembayaran = 'Sudah';
            $itemorder->save();
        }

        // Mengarahkan kembali ke halaman bukti transfer dengan pesan sukses
        return redirect()->route('buktitransfer.index', ['id' => urlencode($request->no_invoice), 'user_id' => $request->user_id])
                        ->with('success', 'Bukti transfer berhasil diunggah.');
    }


}
