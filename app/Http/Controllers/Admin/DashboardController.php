<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\User;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $total_Projects = Project::count();

        $total_Types = Type::count();

        $total_Technologies = Technology::count();

        $total_users = User::count();

        $total_Projects_without_images = Project::whereNull('thumb')->count();

        $total_Projects_with_images = $total_Projects - $total_Projects_without_images;

        return view('admin.dashboard', compact('total_Projects', 'total_Projects_without_images', 'total_Projects_with_images', 'total_users', 'total_Types', 'total_Technologies'));
    }
}
