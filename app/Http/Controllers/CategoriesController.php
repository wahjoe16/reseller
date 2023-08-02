<?php

namespace App\Http\Controllers;

use App\DataTables\CategoriesDataTable;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
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
        $title2 = "Delete Category!";
        $text = "Are you sure you want to delete?";
        confirmDelete($title2, $text);
        $title = "Data of Categories";
        return view('categories.index', compact('title'));
    }

    public function data()
    {
        $data = Category::with('parent')->orderBy('id', 'DESC')->get();
        return datatables()
            ->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '
                <a href="' . route('categories.edit', $data->id) . '" class="btn btn-warning btn-xs">Edit</a>
                <a href="' . route('delete.category', $data->id) . '" class="btn btn-danger btn-xs">Delete</a>
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
        $title = "Add New Category";
        $data = Category::with('parent')->get();
        // dd($data);
        return view('categories.create', compact('title', 'data'));
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
            'title' => 'required|string|max:255|unique:categories',
            'parent_id' => 'exists:categories,id'
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category has been successfull created!');
    }

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
        $data = Category::find($id);
        // dd($data);
        $categories = Category::get();
        return view('categories.edit', compact('data', 'categories'));
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
        $data = Category::findOrFail($id);
        $this->validate($request, [
            'title' => 'required|string|max:255|unique:categories,title,' . $data->id,
            'parent_id' => 'exists:categories,id'
        ]);

        $data->title = $request->title;
        $data->parent_id = $request->parent_id;
        $data->save();
        return redirect()->route('categories.index')->with('success', 'Category has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category successfully deleted!');
    }
}
