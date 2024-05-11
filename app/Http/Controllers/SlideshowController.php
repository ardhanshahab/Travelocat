<?php

namespace App\Http\Controllers;

use App\Models\Slideshow;
use Illuminate\Http\Request;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemslideshow = Slideshow::paginate(10);
        $data = array('title' => 'Slideshow',
                    'itemslideshow' => $itemslideshow);
        return view('slideshow.index', $data)->with('no', ($request->input('page', 1) - 1) * 10);
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
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $itemuser = $request->user();
    
        $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();
        $folder = 'assets/slideshow';
        $request->file('image')->move(public_path($folder), $imageName);
    
        $inputan = $request->all();
        $inputan['user_id'] = $itemuser->id;
        $inputan['foto'] = $folder.'/'.$imageName;
    
        $itemslideshow = Slideshow::create($inputan);
    
        return back()->with('success', 'Image uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemslideshow = Slideshow::findOrFail($id);
        // cek kalo foto bukan null
        if ($itemslideshow->foto != null) {
            \Storage::delete($itemslideshow->foto);
        }
        if ($itemslideshow->delete()) {
            return back()->with('success', 'Data deleted successfully');
        } else {
            return back()->with('error', 'Data failed to delete');
        }
    }
}