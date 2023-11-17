<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{

    # method index - menampilkan data berita
    public function index()
    {
        $berita = News::all();

        if ($berita->isEmpty()) {
            return response()->json(['message' => 'Data is empty'], 200);
        }

        return response()->json(['data' => $berita, 'message' => 'Get All Resource'], 200);

    }

    # method store - menambahkan berita baru
    public function store(Request $request)
    {

        // Validasi data input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string',
            'url' => 'required|url',
            'url_image' => 'required|url',
            'category' => 'required|string',
        ]);

        // validasi gagal, kembalikan respons error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = Category::firstOrCreate(['name' => $request->input('category')]);

        //  validasi berhasil, simpan data
        $berita = new News();
        $berita->title = $request->input('title');
        $berita->author = $request->input('author');
        $berita->description = $request->input('description');
        $berita->content = $request->input('content');
        $berita->url = $request->input('url');
        $berita->url_image = $request->input('url_image');
        $berita->category = $request->input('category');

        $berita->category()->associate($category);
        $berita->save();

        // Kembalikan respons sukses
        return response()->json(['message' => 'Resource is added successfully'], 201);
    }
    # method update - mengambil berita berdasarkan id
    public function show(Request $request, $id)
    {
        $berita = News::find($id);

        if (!$berita) {
            return response()->json(['message' => 'Resource not found.'], 404);
        }

        return response()->json(['data' => $berita, 'message' => 'Get Detail Resource'], 200);
    }

    # method update - mengupdate hewan
    public function update(Request $request, $id)
    {

        $category = Category::firstOrCreate(['name' => $request->input('category')]);
        $berita = News::find($id);

        if (!$berita) {
            return response()->json(['message' => 'Resource not found.'], 404);
        }
        $berita->title = $request->input('title');
        $berita->author = $request->input('author');
        $berita->description = $request->input('description');
        $berita->content = $request->input('content');
        $berita->url = $request->input('url');
        $berita->url_image = $request->input('url_image');
        $berita->category = $request->input('category');

        $berita->category()->associate($category);
        $berita->save();
        // Kembalikan respons sukses
        return response()->json(['message' => 'Resource is update successfully'], 201);
    }

    # method destroy - menghapus hewan
    public function destroy($id)
    {
        $berita = News::find($id);

        if (!$berita) {
            return response()->json(['message' => 'Resource not found.'], 404);
        }

        $berita->delete();

        return response()->json(['message' => 'Resource is deleted successfully'], 200);
    }

    public function search(Request $request, $title)
    {
        $newsByTitle = News::where('title', 'like', "%$title%")->get();

        return response()->json(['data' => $newsByTitle, 'message' => 'Get News by Title'], 200);
    }

    // // mengambil berita berdasarkan category sport

    public function getByCategorySport()
    {
        $sportNews = News::whereHas('category', function ($query) {
            $query->where('name', 'sport');
        })->get();

        return response()->json(['data' => $sportNews, 'message' => 'Get Sport News'], 200);
    }


    // // mengambil berita berdasarkan category finance
    public function getByCategoryfinance()
    {
        $financeNews = News::whereHas('category', function ($query) {
            $query->where('name', 'finance');
        })->get();

        return response()->json(['data' => $financeNews, 'message' => 'Get finance News'], 200);
    }
    // // mengambil berita berdasarkan category Automitive
    public function getByCategoryAutomitive()
    {
        $AutomitiveNews = News::whereHas('category', function ($query) {
            $query->where('name', 'Automitive');
        })->get();

        return response()->json(['data' => $AutomitiveNews, 'message' => 'Get Automitive News'], 200);
    }
}