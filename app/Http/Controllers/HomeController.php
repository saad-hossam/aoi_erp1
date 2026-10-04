<?php

namespace App\Http\Controllers;

use App\Models\Emp;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** Dashboard shown right after login. */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $employees = Emp::query()
            ->whereNotNull('USER_NAME')
            ->search($search)
            ->orderBy('USER_NAME')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.home', compact('employees', 'search'));
    }
}
