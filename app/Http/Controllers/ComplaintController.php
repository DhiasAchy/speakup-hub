<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\FormField;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    public function index() {
        $fields = FormField::orderBy('order')->get();
        return view('complaint.form', compact('fields'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'department' => 'required|string',
            'message' => 'required|string|min:10',
            'email' => 'nullable|email'
        ]);

        $complaint = Complaint::create([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'message' => $request->message,
        ]);

        // Kirim email otomatis ke HR
        Mail::raw("Departemen: {$complaint->department}\n\nPesan:\n{$complaint->message}", function ($msg) use ($complaint) {
            $msg->to('dhias.wirawangroup@gmail.com')
                ->subject("SpeakUp Hub - Aduan Baru");
        });

        return redirect()->back()->with('success', 'Aduan berhasil dikirim.');
    }
}
