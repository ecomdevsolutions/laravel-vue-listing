<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFavorites;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class UserFavoriteController extends Controller
{
    public function gets(Request $request)
    {
        $imgs = DB::table('user_favorites')->where('userid', Auth::id())->get();
        return Inertia::render('Home', [
            'regedImages' => $imgs
        ]);
    }
    
    public function add(Request $request)
    {
        return DB::table('user_favorites')->insert([
            'artid' => $request->input('id'),
            'userid' => Auth::id(),
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'thumbnailUrl' => $request->input('thumbnailUrl')
        ]);
    }

    public function remove(Request $request)
    {
        return DB::table('user_favorites')
                ->where('artid', $request->input('id'))
                ->where('userid', Auth::id())
                ->delete();
    }
}