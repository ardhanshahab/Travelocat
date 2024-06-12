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
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'komentar' => 'required',
            'rating' => 'required|integer|between:1,5',
        ]);

        $user_id = auth()->user()->id;

        $feedbackData = [
            'user_id' => $user_id,
            'email' => $request->input('email'),
            'komentar' => $request->input('komentar'),
            'T1' => $request->input('T1'),
            'T2' => $request->input('T2'),
            'R1' => $request->input('R1'),
            'R2' => $request->input('R2'),
            'S1' => $request->input('S1'),
            'S2' => $request->input('S2'),
            'A1' => $request->input('A1'),
            'A2' => $request->input('A2'),
            'E1' => $request->input('E1'),
            'E2' => $request->input('E2'),
            'rating' => $request->input('rating'),
        ];

        Feedback::create($feedbackData);
        
        return redirect()->route('feedback.index')
            ->with('success', 'Feedback berhasil dikirim.');
    }

    public function listfeedback()
    {
        $feedbacks = Feedback::with('user')->paginate(10);
        $T1 = $feedbacks->sum('T1');
        $T2 = $feedbacks->sum('T2');
        $R1 = $feedbacks->sum('R1');
        $R2 = $feedbacks->sum('R2');
        $S1 = $feedbacks->sum('S1');
        $S2 = $feedbacks->sum('S2');
        $A1 = $feedbacks->sum('A1');
        $A2 = $feedbacks->sum('A2');
        $E1 = $feedbacks->sum('E1');
        $E2 = $feedbacks->sum('E2');
        $responden = Feedback::with('user')->count();
        $satu = 1 / $responden;
        $T1 = $satu * $T1;
        $T2 = $satu * $T2;
        $R1 = $satu * $R1;
        $R2 = $satu * $R2;
        $S1 = $satu * $S1;
        $S2 = $satu * $S2;
        $A1 = $satu * $A1;
        $A2 = $satu * $A2;
        $E1 = $satu * $E1;
        $E2 = $satu * $E2;

        $tangible = ($T1 + $T2) / 2;
        $reability = ($R1 + $R2) / 2;
        $responsive = ($S1 + $S2) / 2;
        $assurance = ($A1 + $A2) / 2;
        $empaty = ($E1 + $E2) / 2;

        $title = 'Travelocat';
        return view('feedback.listfeedback', compact('feedbacks', 'title', 'tangible', 'reability', 'responsive', 'assurance', 'empaty'));
    }
}
