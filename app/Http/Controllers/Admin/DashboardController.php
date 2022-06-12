<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        redirect('/dashboard/orders');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users.index', [
            'title' => 'User List | Cofftea Administrator',
            'users' => $users
        ]);
    }

    public function viewUser($id)
    {
        $user = User::find($id);
        return view('admin.users.view', [
            'title' => 'User Details | Cofftea Administratorss',
            'user' => $user
        ]);
    }
}
