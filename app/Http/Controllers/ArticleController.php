<?php

namespace App\Http\Controllers;

use App\Models\article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request ,article $products)
    {
        $products=$products->newQuery();
        if ($request->has("name")){
        return $products->where('name',$request->get("name"))->get();
    }
    else if ($request->has("categorie_id")){
        return $products->where('categorie_id',$request->get("categorie_id"))->get() ;
    }
        return  article::all();


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $path = $request->file('image')->store('public/article');
        $url=explode("/",$path);
        $real_path="storage/$url[1]/$url[2]";
        $save = new article();
        $save->image =$real_path;
        $save->name =$request->input(["name"]);
        $save->price =(int)$request->get('price');
        $save->categorie_id = (int)$request->get('categorie_id');
        $save->save();

        Return response()->json($save);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\article  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $article= article::find($id);

        Return response()->json($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,article $product)
    {
        $input=$request->all();
        $product->update($input);
        $product->save();
            return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\article  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $article = Article::findOrFail($id);
        if($article)
            $article->delete();
        else
            return response()->json("eureur");
        return response()->json(null);
    }

}
