<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        $userUrls=Url::where('user_id', $user_id)->latest()->paginate(3);
        return response()->json($userUrls);
    }
    public function mostVisited($user_id)
    {
        $mostVisited=Url::orderBy('visits','desc')->take(3)->get();
        return response()->json($mostVisited);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        $url=Url::create([
            'full_url'=>$request->full_url,
            'url_desc'=>$request->url_desc,
            'shorten_url'=>Str::random(),
            'user_id'=>$request->user_id,
            'visits'=>0,
        ]);
        return response()->json($url);

    }


    /**
     * Display the specified resource.
     */
    public function show( $shorten_url)
    {
        $url=Url::where('shorten_url', $shorten_url)->first();
        $url->increment('visits');
        // dd($url);
         return redirect($url->full_url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $shorten_url)
    {
        $url=Url::where('shorten_url',$shorten_url)->first();
      dd($url);
        return response()->json($url);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUrlRequest $request, $shorten_url)
    {
        $url= Url::where('shorten_url', $shorten_url)->first();
        $url->update([
            'full_url'=>$request->full_url,
            'url_desc'=>$request->url_desc,
            'user_id'=>$request->user_id,
        ]);
        return response()->json($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($shorten_url)
    {
       $url= Url::where('shorten_url', $shorten_url)->first();
        $url->delete();
        return response()->json([
            'success'=>'url has been deleted successfuly ',
                    ]);
    }
}
