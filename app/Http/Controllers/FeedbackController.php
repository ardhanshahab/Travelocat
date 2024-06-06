<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        $title = 'Travelocat';
        return view('feedback.index', compact('feedbacks', 'title'));
    }

    public function create()
    {
        return view('feedback.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'komentar' => 'required',
            'rating' => 'required|integer|between:1,5',
        ]);

        Feedback::create($request->all());
        
        return redirect()->route('feedback.index')
            ->with('success', 'Feedback berhasil dikirim.');
    }
}
