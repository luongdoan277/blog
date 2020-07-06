<?php

namespace App\Http\Controllers;

use App\Model\Gallery;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $newFileName = $request->get('name');
        $fileName = $request->image->getClientOriginalName();
        $fileType = $request->image->getMimeType();
        $fileTempName = $request->image->getPathName();
        $fileError = $request->image->getError();
        $fileSize = $request->image->getSize();
        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array("jpg", "jpeg", "png");
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 2000000) {
                    $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                    $sql = Gallery::all();
                    if (!$sql) {
                        echo "SQL statement failed!";
                    } else {
                        $result = DB::table("gallery")->get();
                        $rowCount = count($result);
                        $setImageOrder = $rowCount + 1;

                        $gallery = Gallery::create([
                            'titleGallery'=>$request->get('titleGallery'),
                            'descGallery'=>$request->get('descGallery'),
                            'imgFullNameGallery'=>$imageFullName,
                            'orderGallery'=>$setImageOrder,
                        ]);
                        $gallery->save();
                        if (!$gallery->save()) {
                            echo "SQL statement failed!";
                        } else {
                            $gallery->save();
                            $request->image->move('img/gallery', $imageFullName);
                            return redirect('/');
                        }
                    }
                } else {
                    echo "File size is too big!";
                    exit();
                }
            } else {
                echo "You had an error!";
                exit();
            }
        } else {
            echo "You need to upload a proper file type!";
            exit();
        }
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
