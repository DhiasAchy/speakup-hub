<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\FormDesign;
use App\Models\Complaint;
use App\Models\EmailRecipient;
use App\Models\Setting;

class FormController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $design = FormDesign::latest()->first();
        return view('user.complain-form', compact('design', 'setting'));
    }

    public function submit(Request $request)
    {
        // Simpan semua data ke tabel complaints
        // $complaint = Complaint::create([
        //     'name'    => $request->input('name', 'Anonim'),
        //     'email'   => $request->input('email'),
        //     'data' => json_encode($request->except('_token')), // Simpan semua input
        // ]);
        $complaint = Complaint::create([
            'data' => json_encode($request->except('_token')),
        ]);

        // Bangun HTML table untuk email
        $fields = "";
        foreach ($request->except('_token') as $key => $value) {
            $fields .= "
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd;'><strong>" . ucfirst($key) . "</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>" . nl2br(e($value)) . "</td>
                </tr>";
        }

        $htmlBody = "
            <h2 style='color:#007bff;'>📩 SpeakUp Hub - Aduan Baru</h2>
            <table style='border-collapse: collapse; width: 100%; font-family: Arial, sans-serif;'>
                $fields
            </table>
        ";

        // Ambil semua email penerima dari database
        $recipients = EmailRecipient::pluck('email')->toArray();

        // Kirim email ke semua penerima
        Mail::send([], [], function ($message) use ($recipients, $htmlBody) {
            $message->to($recipients)
                    ->subject('SpeakUp Hub - Aduan Baru')
                    ->setBody($htmlBody, 'text/html');
        });

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim dan disimpan!');
    }

}
