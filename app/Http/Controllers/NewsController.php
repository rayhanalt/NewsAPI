<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comments;
use App\Events\NewsCreated;
use App\Events\NewsDeleted;
use App\Events\NewsUpdated;
use Illuminate\Http\Request;
use App\Http\Resources\NewsResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Event;
use App\Http\Resources\DetailNewsResource;
use App\Http\Resources\DetailCommentsResource;


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
        $news = News::latest()->paginate(5);
        return new NewsResource($news);
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

        $news = News::create($validatedData);
        event(new NewsCreated($news));

        return response()->json(['message' => 'News created successfully.', 'data' => new NewsResource($news)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $commentInfo = Comments::with('hasUser', 'hasNews')->where('news_id', $news->id)->latest()->get();

        return response()->json(['message' => 'Detail News.', 'News Info' => new DetailNewsResource($news), 'Comments' => DetailCommentsResource::collection($commentInfo)], 200);
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
        event(new NewsUpdated($news));
        return response()->json(['message' => 'News Updated successfully.', 'data' => new NewsResource($news)], 200);
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
        event(new NewsDeleted($news));
        $news->delete();
        return response()->json(['message' => 'News Deleted successfully.', 'deleted data' => new DetailNewsResource($news)], 200);
    }
}
