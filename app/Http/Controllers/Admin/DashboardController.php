<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\User;
use App\Models\FormDesign;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalComplaints' => Complaint::count(),
            'totalUsers' => User::count(),
            'totalFields' => FormDesign::count(),
        ]);
    }
}

?>
