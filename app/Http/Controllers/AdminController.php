<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trade;
use App\Models\Traders;
use PDO;

class AdminController extends Controller
{
    public function AdminDashboard(){
        $tradersCount = Traders::all();
        return view('admin.dashboard', compact('tradersCount'));
    }
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function trades()
    {
        $trades = Trade::with('user')->latest()->get();
        return view('admin.trades', compact('trades'));
    }
}
