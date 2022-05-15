<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::where('user_id', auth()->user()->id)->get();
        // $categories = Category::all();
        $categories = Category::latest()->filter(request(['search']))->paginate(5);
        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ],
        [
            'name.required' => "Nama kategori harus diisi",
            "name.max" => "Karakter tidak boleh lebih dari 255"
        ]);

        //create category
        $category = new Category();
        $category->name = $request->name;
        $category->user_id = auth()->user()->id;
        $category->save();
        $request->session()->flash('success', 'A new category has been created');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        if(!$category)
        {
            return view('notfound');
        }
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $category = Category::find($id);
        if($category->user_id != auth()->user()->id)
        {
            $request->session()->flash('error', 'This is not yours so you have no right to edit this category');
            return redirect(route('categories.index'));
        }
        return view('category.edit', ['category'=> $category]);
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
        $request->validate([
            'name' => 'max:255'
        ],
        [
            "name.max" => "Karakter tidak boleh lebih dari 255"
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        $category = Category::find($id);
        if($category->user_id != auth()->user()->id)
        {
            $request->session()->flash('error', 'This is not yours so you have no right to delete this category');
        }
        else if($category->articles->isNotEmpty())
        {
            $request->session()->flash('error', 'Cannot be removed because there is article that references to this category. Delete the article first so you can delete this afterwards.');
        }else{
            $category->delete();
        }
        return redirect(route('categories.index'));
    }
}
