<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    public function index() {
        $fields = FormField::orderBy('order')->get();
        return view('admin.fields.index', compact('fields'));
    }

    public function create() {
        return view('admin.fields.create');
    }

    public function store(Request $request) {
        FormField::create($request->all());
        return redirect()->route('admin.fields.index')->with('success', 'Field berhasil ditambahkan');
    }

    public function edit($id) {
        $field = FormField::findOrFail($id);
        return view('admin.fields.edit', compact('field'));
    }

    public function update(Request $request, $id) {
        $field = FormField::findOrFail($id);
        $field->update($request->all());
        return redirect()->route('admin.fields.index')->with('success', 'Field berhasil diupdate');
    }

    public function destroy($id) {
        FormField::destroy($id);
        return redirect()->route('admin.fields.index')->with('success', 'Field berhasil dihapus');
    }
}
