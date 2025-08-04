<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailRecipient;

class EmailRecipientController extends Controller
{
    public function index()
    {
        $recipients = EmailRecipient::all();
        return view('admin.settings.email-recipients', compact('recipients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:email_recipients,email',
        ]);

        EmailRecipient::create(['email' => $request->email]);

        return back()->with('success', 'Email recipient added successfully.');
    }

    public function destroy($id)
    {
        EmailRecipient::findOrFail($id)->delete();
        return back()->with('success', 'Recipient removed.');
    }
}
