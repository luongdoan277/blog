<?php

namespace App\Http\Controllers;

use App\Model\Gallery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $Gallery = Gallery::all();
        return view('gallery.index', compact('Gallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('gallery.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'titleGallery'=>'required',
            'discGallery'=>'required',
            'imgFullNameGallery'=>'required',
            'orderGallery'=>'required',
        ]);
        $gallery = Gallery::create([
            'titleGallery'=>$request->get('titleGallery'),
            'discGallery'=>$request->get('discGallery'),
            'imgFullNameGallery'=>$request->get('imgFullNameGallery'),
            'orderGallery'=>$request->get('orderGallery'),
        ]);
        $gallery->save();
        return redirect('/')->with('success','Gallery save!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
