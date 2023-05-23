<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailNewsResource;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class NewsController extends Controller
{
    protected function role()
    {
        if (Auth::user()->role != 'admin') {
            return response()->json(['message' => 'Anda bukan admin'], 403)->throwResponse();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // 3 news terakhir
        $news = News::latest()->take(3)->get();
        // 10 news lainnya
        $newsAll = News::latest()->skip(3)->take(10)->get();
        return new NewsResource(['latest' => $news, 'others' => $newsAll]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->role();
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mendapatkan file gambar yang diupload
        $validatedData['image'] = $request->file('image');

        // Menyimpan file ke direktori public/image
        $fileName = uniqid() . '.' . $validatedData['image']->getClientOriginalExtension();
        $validatedData['image']->move(public_path('images'), $fileName);
        $validatedData['image'] = $fileName;

        $createNews = News::create($validatedData);

        return response()->json(['message' => 'News created successfully.', 'data' => new NewsResource($createNews)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {

        // $editNews = News::where('id', $news->id)->get();
        // return NewsResource::collection($editNews);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $this->role();

        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // simpan gambar
        if ($request->file('image')) {
            // menghapus gambar sebelumnya
            if ($news->image) {
                File::delete(public_path('images/' . $news->image));
            }
            // memindahkan image ke public/image
            $validatedData['image'] = $request->file('image');

            // membuat filename random
            $fileName = uniqid() . '.' . $validatedData['image']->getClientOriginalExtension();
            $validatedData['image']->move(public_path('images'), $fileName);
            $validatedData['image'] = $fileName;
        }

        $news->update($validatedData);

        return response()->json(['message' => 'News Updated successfully.', 'data' => new DetailNewsResource($news)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $this->role();
        File::delete(public_path('images/' . $news->image));
        $news->delete();
        return response()->json(['message' => 'News Deleted successfully.', 'deleted data' => new DetailNewsResource($news)], 200);
    }
}
