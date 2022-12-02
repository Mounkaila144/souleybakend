<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categorie = categorie::all()->toArray();
        Return array_reverse($categorie);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $path = $request->file('image')->store('public/categories');
        $url=explode("/",$path);
        $real_path="storage/$url[1]/$url[2]";

        $save = new categorie();
        $save->name =$request->input(["name"]);
        $save->image =$real_path;
        $save->save();

        Return response()->json($save);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categorie  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $categorie= categorie::find($id);

        Return response()->json($categorie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id)
    {
        $input=$request->all();
        $product=categorie::find($id);
        $product->update($input);
        $product->save();
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categorie  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $article = categorie::findOrFail($id);
        if($article)
            $article->delete();
        else
            return response()->json("eureur");
        return response()->json(null);
    }
}
