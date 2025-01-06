<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function short(Request $request){
        $validated = $request->validate([
            'url' => 'required|url'
        ]);

        $link = Link::create([
            'url' => $validated['url'],
            'hash' => Str::random(6),
            'clicks' => 0
        ]);

        return response()->json($link);
    }

    public function redirect($hash){
        $link = Link::where('hash', $hash)->firstOrFail();
        $link->increment('clicks');
        return redirect($link->url);
    }

    public function clicks($hash){
        $link = Link::where('hash', $hash)->firstOrFail();
        return response()->json(['clicks' => $link->clicks]);
    }
}
