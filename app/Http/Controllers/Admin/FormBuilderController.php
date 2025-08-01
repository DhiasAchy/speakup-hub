<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormDesign;

class FormBuilderController extends Controller
{
    public function index()
    {
        $design = FormDesign::latest()->first();
        return view('admin.form-builder', compact('design'));
    }

    public function save(Request $request)
    {
        FormDesign::create([
            'json_schema' => $request->input('schema')
        ]);

        return response()->json(['success' => true]);
    }
}
