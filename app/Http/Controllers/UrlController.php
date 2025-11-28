<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            return back()->withErrors('SuperAdmin cannot see list of short URLs.');
        }

        if ($user->role === 'admin') {
            $urls = Url::whereHas('user', function($q) use ($user) {
                $q->where('company_id', '!=', $user->company_id);
            })->get();
        } 
        elseif ($user->role === 'member') {
            $urls = Url::where('user_id', '!=', $user->id)->get();
        } 
        else {
            $urls = Url::all();
        }

        return view('urls.index', compact('urls'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!in_array($user->role, ['sales','manager'])) {
            return back()->withErrors('You are not allowed to create short URLs.');
        }

        $request->validate([
            'original_url' => 'required|url'
        ]);

        Url::create([
            'user_id' => $user->id,
            'original_url' => $request->original_url,
            'slug' => Str::random(6),
            'secret_token' => Str::random(32),
        ]);

        return redirect()->back()->with('success', 'Short URL created');
    }

    public function redirectToOriginal(Request $request, $slug)
    {
        $url = Url::where('slug', $slug)->firstOrFail();

        if ($request->token !== $url->secret_token) {
            abort(403);
        }

        return redirect()->away($url->original_url);
    }
}
