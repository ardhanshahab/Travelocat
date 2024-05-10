<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Image;
use App\Models\ProdukImage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemproduk = Produk::orderBy('created_at', 'desc')->paginate(20);
        $data = array('title' => 'Product',
                    'itemproduk' => $itemproduk);
        return view('produk.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $data = array('title' => 'Form New Product',
                    'itemkategori' => $itemkategori);
        return view('produk.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_produk' => 'required|unique:produk',
            'nama_produk' => 'required',
            'slug_produk' => 'required',
            'deskripsi_produk' => 'required',
            'kategori_id' => 'required',
            'qty' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric'
        ]);
        $itemuser = $request->user();//ambil data user yang login
        $slug = \Str::slug($request->slug_produk);//buat slug dari input slug produk
        $inputan = $request->all();
        $inputan['slug_produk'] = $slug;
        $inputan['user_id'] = $itemuser->id;
        $inputan['status'] = 'publish';
        $itemproduk = Produk::create($inputan);
        return redirect()->route('produk.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itemproduk = Produk::findOrFail($id);
        $data = array('title' => 'Product Image',
                'itemproduk' => $itemproduk);
        return view('produk.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemproduk = Produk::findOrFail($id);
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $data = array('title' => 'Form Edit Product',
                'itemproduk' => $itemproduk,
                'itemkategori' => $itemkategori);
        return view('produk.edit', $data);
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
        $this->validate($request, [
            'kode_produk' => 'required|unique:produk,id,'.$id,
            'nama_produk' => 'required',
            'slug_produk' => 'required',
            'deskripsi_produk' => 'required',
            'kategori_id' => 'required',
            'qty' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric'
        ]);
        $itemproduk = Produk::findOrFail($id);
        // kalo ga ada error page not found 404
        $slug = \Str::slug($request->slug_produk);//slug kita gunakan nanti pas buka produk
        // kita validasi dulu, biar tidak ada slug yang sama
        $validasislug = Produk::where('id', '!=', $id)//yang id-nya tidak sama dengan $id
                                ->where('slug_produk', $slug)
                                ->first();
        if ($validasislug) {
            return back()->with('error', 'Slug already exists, try something else');
        } else {
            $inputan = $request->all();
            $inputan['slug'] = $slug;
            $itemproduk->update($inputan);
            return redirect()->route('produk.index')->with('success', 'Data successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemproduk = Produk::findOrFail($id);//cari berdasarkan id = $id, 
        // kalo ga ada error page not found 404
        if ($itemproduk->delete()) {
            return back()->with('success', 'Data deleted successfully');
        } else {
            return back()->with('error', 'Data failed to delete');
        }
    }
    public function loadasync($id) {
        $itemproduk = Produk::findOrFail($id);
        $respon = [
            'status' => 'success',
            'msg' => 'Data found',
            'itemproduk' => $itemproduk
        ];
        return response()->json($respon, 200);
    }


}