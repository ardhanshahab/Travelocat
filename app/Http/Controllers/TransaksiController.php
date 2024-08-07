<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\AlamatPengiriman;
use App\Models\Order;
use App\Models\Produk;
use App\Models\notif;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PaymentAndShippingStatus;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $itemorder = Order::orderBy('created_at', 'desc')->paginate(20);
        // $data = array('title' => 'Transaction Data',
        //             'itemorder' => $itemorder);
        //             return view('transaksi.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
        $itemuser = $request->user();
        if ($itemuser->role == 'admin') {
            // kalo admin maka menampilkan semua cart
            $itemorder = Order::whereHas('cart', function($q) use ($itemuser) {
                            $q->where('status_cart', 'checkout');
                        })
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);
        } else {
            // kalo member maka menampilkan cart punyanya sendiri
            $itemorder = Order::whereHas('cart', function($q) use ($itemuser) {
                            $q->where('status_cart', 'checkout');
                            $q->where('user_id', $itemuser->id);
                        })
                        ->orderBy('created_at', 'desc')
                        ->paginate(20);
        }
        $notifications = Notif::where('user_id', Auth::id())->orderBy('created_at', 'desc')->limit(5)->get();

        $data = array('title' => 'Transaction Data',
                    'itemorder' => $itemorder,
                    'notifications' => $notifications,
                    'itemuser' => $itemuser);
        return view('transaksi.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $itemuser = $request->user();
        $itemcart = Cart::where('status_cart', 'cart')
                        ->where('user_id', $itemuser->id)
                        ->first();
        if ($itemcart) {
            $itemalamatpengiriman = AlamatPengiriman::where('user_id', $itemuser->id)
                                                    ->where('status', 'utama')
                                                    ->first();
            if ($itemalamatpengiriman) {
                // buat variabel inputan order
                $inputanorder['cart_id'] = $itemcart->id;
                $inputanorder['nama_penerima'] = $itemalamatpengiriman->nama_penerima;
                $inputanorder['no_tlp'] = $itemalamatpengiriman->no_tlp;
                $inputanorder['alamat'] = $itemalamatpengiriman->alamat;
                $inputanorder['provinsi'] = $itemalamatpengiriman->provinsi;
                $inputanorder['kota'] = $itemalamatpengiriman->kota;
                $inputanorder['kecamatan'] = $itemalamatpengiriman->kecamatan;
                $inputanorder['kelurahan'] = $itemalamatpengiriman->kelurahan;
                $inputanorder['kodepos'] = $itemalamatpengiriman->kodepos;
                // $inputanorder['qty'] = $itemcart->detail->qty;
                // $produk = Produk::findOrFail($itemcart->detail->produk_id);
                // if($produk->qty == 0){
                //     return back()->with('error', 'Quantity is empty');
                // }
                $itemorder = Order::create($inputanorder);
                $itemcart->update(['status_cart' => 'checkout']);
                // $itemcart->update($produk->qty - $itemcart->detail->qty);
                 // Buat notifikasi pembayaran
                Notif::create([
                    'user_id' => $itemuser->id,
                    'message' => 'Segera Lakukan Pembayaran untuk pesanan dengan ID: ' . $itemcart->no_invoice,
                    'read' => false,
                    'tipe' => '0',
                ]);

                // Buat notifikasi pengiriman
                Notif::create([
                    'user_id' => $itemuser->id,
                    'message' => 'Pesanan Anda dengan ID: ' . $itemcart->no_invoice . ' sedang dalam proses pembayaran.',
                    'read' => false,
                    'tipe' => '2',
                ]);
                return redirect()->route('feedback.index')->with('success', 'Segera Lakukan Pembayaran untuk pesanan anda');
            } else {
                return back()->with('error', 'The shipping address has not been filled in');
            }
        } else {
            return abort('404');//kalo ternyata ga ada shopping cart, maka akan menampilkan error halaman tidak ditemukan
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        $itemuser = $request->user();
        if ($itemuser->role == 'admin') {
            $itemorder = Order::findOrFail($id);
            $data = array('title' => 'Transaction Detail',
                        'itemorder' => $itemorder);
            return view('transaksi.show', $data)->with('no', 1);            
        } else {
            $itemorder = Order::where('id', $id)
                            ->whereHas('cart', function($q) use ($itemuser) {
                                $q->where('user_id', $itemuser->id);
                            })->first();
            if ($itemorder) {
                $data = array('title' => 'Transaction Detail',
                            'itemorder' => $itemorder);
                return view('transaksi.show', $data)->with('no', 1);                            
            } else {
                return abort('404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $itemuser = $request->user();
        if ($itemuser->role == 'admin') {
            $itemorder = Order::findOrFail($id);
            $data = array('title' => 'Form Edit Transaction',
                        'itemorder' => $itemorder);
            return view('transaksi.edit', $data)->with('no', 1);            
        } else {
            return abort('404');//kalo bukan admin maka akan tampil error halaman tidak ditemukan
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request,[
            'status_pembayaran' => 'required',
            'status_pengiriman' => 'required',
            'subtotal' => 'required|numeric',
            'ongkir' => 'required|numeric',
            'diskon' => 'required|numeric',
            'total' => 'required|numeric',
        ]);
        $inputan = $request->all();
        $inputan['status_pembayaran'] = $request->status_pembayaran;
        $inputan['status_pengiriman'] = $request->status_pengiriman;
        $inputan['subtotal'] = str_replace(',','',$request->subtotal);
        $inputan['ongkir'] = str_replace(',','',$request->ongkir);
        $inputan['diskon'] = str_replace(',','',$request->diskon);
        $inputan['total'] = str_replace(',','',$request->total);
        $itemorder = Order::findOrFail($id);
        // dd($itemorder->cart);
        $itemorder->cart->update($inputan);
        if($request->status_pembayaran == 'sudah'){
            Notif::create([
                'user_id' => $itemorder->cart->user_id,
                'message' => $itemorder->cart->no_invoice . '-' . 'Terimakasih sudah melakukan Pembayaran untuk pesanan dengan ID: ' . $itemorder->cart->no_invoice,
                'read' => false,
                'tipe' => '2',

            ]);
    
            // Buat notifikasi pengiriman
            Notif::create([
                'user_id' => $itemorder->cart->user_id,
                'message' => $itemorder->cart->no_invoice . '-' .  'Pesanan Anda dengan ID: ' . $itemorder->cart->no_invoice . ' sedang dalam proses pengiriman, klik konfirmasi penerimaan jika barang sudah diterima.',
                'read' => false,
                'tipe' => '1',
            ]);
            Notif::create([
                'user_id' => '1',
                'message' => 'Pesanan dengan ID: ' . $itemorder->cart->no_invoice . ' sudah membayar.',
                'tipe' => '2',
            ]);    
        }
        if($request->status_pengiriman == 'sudah'){
            // Buat notifikasi pengiriman
            Notif::create([
                'user_id' => $itemorder->cart->user_id,
                'message' => 'Pesanan Anda dengan ID: ' . $itemorder->cart->no_invoice . ' sudah diterima, terimakasih telah berbelanja di toko kami.',
                'read' => false,
                'tipe' => '2',
            ]);
            Notif::create([
                'user_id' => '1',
                'message' => 'Pesanan dengan ID: ' . $itemorder->cart->no_invoice . ' sudah diterima.',
                'tipe' => '2',
            ]);    
        }
        return back()->with('success','Order successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function invoice($id, $ids)
    {
        $itemuser = User::findOrFail($ids);
        // return $itemuser;

        // Decode the URL-encoded invoice ID
        $invoiceId = urldecode($id);
        // return response()->json($invoiceId);
        // Retrieve the user's address
        $alamat = AlamatPengiriman::where('user_id', $itemuser->id)->first();

        // Retrieve the cart details for the user with the decoded invoice ID
        $itemcart = Cart::with('detail.produk')
                        ->where('user_id', $itemuser->id)
                        ->where('no_invoice', $invoiceId)
                        ->first();

        // Check if the cart was found and return data
        if (!$itemcart) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }
        $data = $itemcart;
        // Return the data and render the view
        return view('invoice.invoice', compact('data', 'itemuser', 'alamat'));
    }

}