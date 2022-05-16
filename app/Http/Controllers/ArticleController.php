<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;



class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->filter(request(['search']))->paginate(6);
        View::make('article.show')->withModel($articles);
        return view('article.index2', ['articles' => $articles]);
    }
    public function myIndex(){
        $articles = Article::where('user_id', auth()->user()->id)->latest()->filter(request(['search']))->paginate(6);
        View::make('article.show')->withModel($articles);
        return view('article.index', ['articles' => $articles]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::where('user_id', auth()->user()->id)->get();
        $categories = Category::all();
        return view('article.create',compact('categories'));
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
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
        ]); 

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('image'), $imageName);
        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $imageName;
        $article->user_id = auth()->user()->id;
        $article->category_id = $request->category_id;
        $article->save();
        $request->session()->flash('success', 'A new article has been created');
        return redirect('/myarticles');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();
        return view('article.edit', ['article'=> $article, 'categories'=>$categories]);
    
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
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
        ]); 
        $article = Article::find($id);
        if($request->has('image')){
            $imageName = time().'.'.$request->image->extension();   
            $request->image->move(public_path('image'), $imageName);
            $article->image = $imageName;
        }
        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category_id;
        $article->save();
        $request->session()->flash('success', "$article->title has been updated");
        
        return redirect(route('myarticles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $article = Article::find($id);
        $article->delete();
        $request->session()->flash('success', "$article->title has been deleted");
        return redirect(route('myarticles'));
    }
}
