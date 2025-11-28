<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Url;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {

            case 'SuperAdmin':
                return view('dashboard.superadmin', [
                    'companies' => Company::all(),
                    'users' => User::all(),
                ]);

            case 'Admin':
                return view('dashboard.admin', [
                    'companyUsers' => User::where('company_id', $user->company_id)->get(),
                    'externalUrls' => Url::whereHas('user', function ($q) use ($user) {
                        $q->where('company_id', '!=', $user->company_id);
                    })->get(),
                ]);

            case 'Member':
                return view('dashboard.member', [
                    'urls' => Url::where('user_id', '!=', $user->id)->get(),
                ]);

            case 'Sales':
            case 'Manager':
                return view('dashboard.employee', [
                    'myUrls' => Url::where('user_id', $user->id)->get(),
                ]);
        }

        abort(403);
    }
}
