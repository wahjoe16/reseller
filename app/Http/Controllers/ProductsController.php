<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Product::get();
        // dd($data);
        $title2 = "Delete Product!";
        $text = "Are you sure you want to delete?";
        confirmDelete($title2, $text);
        $title = "Data of Products";
        return view('products.index', compact('title'));
    }

    public function data()
    {
        $data = Product::get();

        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '
                <a href="' . route('products-reseller.show', $data->id) . '" class="btn btn-primary btn-xs">Show</a>
                <a href="' . route('products-reseller.edit', $data->id) . '" class="btn btn-warning btn-xs">Edit</a>
                <a href="' . route('products-reseller.destroy', $data->id) . '" class="btn btn-danger btn-xs" data-confirm-delete="true">Delete</a>
            ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Product";
        $category = Category::get();
        // dd($category);
        return view('products.create', compact('title', 'category'));
    }

    protected function savePhoto(UploadedFile $photo)
    {
        $dest_path = 'img/products';
        $productName = 'product_' . date('d-m-YHis') . '_' . $photo->getClientOriginalName();
        $photo->move($dest_path, $productName);
        return $productName;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:products',
            'model' => 'required',
            'photo' => 'mimes:jpeg,png|max:10240',
            'price' => 'required|numeric|min:1000'
        ]);

        $data = $request->only('name', 'model', 'price');

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->savePhoto($request->file('photo'));
        }

        $new_product = Product::create($data);
        $new_product->categories()->sync($request['category']);


        return redirect()->route('products-reseller.index')->with('success', 'Product created successfully!');
    }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|unique:products',
    //         'model' => 'required',
    //         'photo' => 'mimes:jpeg,png|max:10240',
    //         'price' => 'required|numeric|min:1000'
    //     ]);

    //     $data = $request->only('name', 'model', 'price');

    //     if ($request->hasFile('photo')) {
    //         $productPhoto = $request->file('photo');
    //         $productName = 'product_' . date('d-m-YHis') . '_' . $productPhoto->getClientOriginalName();
    //         $productPhoto->storeAs('products', $productName);

    //         $data['photo'] = $productName;
    //     }
    //     $new_product = Product::create($data);
    //     $new_product->categories()->sync($request['category']);


    //     return redirect()->route('products.index')->with('success', 'Product created successfully!');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::with('categories')->findOrFail($id);
        $category = Category::get();
        // dd($data);
        return view('products.edit', compact('data', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $this->validate($request, [
            'name' => 'required|unique:products,name,' . $product->id,
            'model' => 'required',
            'photo' => 'mimes:jpeg,png|max:10240',
            'price' => 'required|numeric|min:1000'
        ]);

        $data = $request->only('name', 'price', 'model');

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->savePhoto($request->file('photo'));
            if ($product->photo !== '') $this->deletePhoto($product->photo);
        }

        $product->update($data);
        if (count($request->get('category')) > 0) {
            $product->categories()->sync($request->get('category'));
        } else {
            $product->categories()->detach();
        }

        return redirect()->route('products-reseller.index')->with('success', 'Product has been successfully updated');
    }

    // DELETE PHOTO FUNCTION
    public function deletePhoto($productPhoto)
    {
        $path = 'img/products/' . $productPhoto;
        return File::delete($path);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        if ($data->photo !== '') $this->deletePhoto($data->photo);
        $data->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}
