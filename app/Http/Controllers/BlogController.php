<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
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
        $blogs = Blog::all();
        return view('blog.manage',compact(['blogs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('blog.create',compact(['categories']));
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
            'title' => ['required'],
            'categories' => ['required'],
            'short_description' => ['required'],
            'body'   => ['required'],
            'author' => ['required'],
        ]);
        $categories = $request->categories;
        $blog_category = [];
        DB::beginTransaction();
        try {
            $blog = Blog::create([
                'title' => $request->title,
                'short_description' => $request->short_description,
                'body'  => $request->body,
                'author'=> $request->author,
            ]);
            foreach ($categories as $category) {
                array_push($blog_category,["blog_id" => $blog->id ,"category_id"=> $category]);
            }
            DB::table('blog_categories')->insert($blog_category);
            DB::commit();
            return response()->json(["status"=>true,"msg"=>"Blog successfully created"]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(["status"=>true,"msg"=>"Blog didn't created, Try again"]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('blog.show',compact(['blog']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function home()
    {
        $blogs = Blog::all();
        return view('blog.home',compact(['blogs']));
    }

    public function dateFilter(Request $request)
    {
        $blogs = Blog::whereBetween('created_at',[$request->searchByFromdate,$request->searchByTodate])->get();
        $data = [$blogs];
        return response()->json($data);
    }
}




