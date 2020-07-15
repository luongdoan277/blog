<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $Product = Product::all();
        return view('product.index', compact('Product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('product.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request`
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
                    $sql = Product::all();
                    if (!$sql) {
                        echo "SQL statement failed!";
                    } else {
                        $product = Product::create([
                            'name'=>$request->get('name'),
                            'price'=>$request->get('price'),
                            'imgFull'=>$imageFullName,
                        ]);
                        $product->save();
                        if (!$product->save()) {
                            echo "SQL statement failed!";
                        } else {
                            $product->save();
                            $request->image->move('img/gallery', $imageFullName);
                            return redirect('/product');
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
     * @return Application|Factory|Response|View|string
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return 'Name: ' . $product->name
            . '<br/>Price: ' . $product->price
            . '<br/>Image: ' . $product->imgFull;
    }

    public function searchByName(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->value . '%')->get();

        return response()->json($products);
    }

    public function searchById(Request $request)
    {
        $products = Product::where('id', 'like', '%' . $request->value . '%')->get();

        return response()->json($products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = Product::find($id);
        $newFileName = $request->get('name');
        $fileName = $request->get('image')->getClientOriginalName();
        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
        $product -> name = $request->get('name');
        $product -> price =$request->get('price');
        $product -> imgFull = $imageFullName;
        $product->save();
        $request->get('image')->move('img/gallery', $imageFullName);
        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/product');
    }
}
