<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::latest()->paginate(10);
        return view('admin.complaints.index', compact('complaints'));
    }

    public function export(): StreamedResponse
    {
        $complaints = Complaint::all();
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=complaints.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($complaints) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Created At', 'Data']);

            foreach ($complaints as $complaint) {
                fputcsv($file, [
                    $complaint->id,
                    $complaint->created_at,
                    $complaint->data
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
