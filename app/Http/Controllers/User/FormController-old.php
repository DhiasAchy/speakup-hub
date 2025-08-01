<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\FormDesign;
use App\Models\Complaint;

class FormController extends Controller
{
    public function index()
    {
        $design = FormDesign::latest()->first();
        return view('user.complain-form', compact('design'));
    }

    public function submit(Request $request)
    {
        $complaint = Complaint::create([
            'name' => $request->input('name', 'Anonim'),
            'email' => $request->input('email'),
            'message' => json_encode($request->except('_token')),
        ]);

        // Siapkan isi pesan dari semua field
        $fields = "";
        foreach ($request->except('_token') as $key => $value) {
            $fields .= ucfirst($key) . ": " . $value . "\n";
        }

        // Kirim email ke HR
        $hrEmail = "dhias.wirawangroup@gmail.com"; // ganti dengan email HR asli

        // Mail::send([], [], function($message) use ($hrEmail, $complaint) {
        //     $message->to($hrEmail)
        //             ->subject('Pengaduan Baru - SpeakUp Hub')
        //             ->setBody(
        //                 "Ada pengaduan baru:\n\n".
        //                 "Nama: {$complaint->name}\n".
        //                 "Email: {$complaint->email}\n".
        //                 "Isi Pengaduan:\n{$complaint->message}"
        //             );
        // });

        Mail::send([], [], function($message) use ($complaint, $fields) {
            $message->to('dhias.wirawangroup@gmail.com') // ganti dengan email HR
                    ->subject('SpeakUp Hub - Aduan Baru')
                    ->setBody($fields);
        });

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim dan email terkirim ke HR!');
    }
}
