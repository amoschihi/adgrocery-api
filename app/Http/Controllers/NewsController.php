<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'], ['except' => ['get']]);
    }

    //
    public function get(Request $request)
    {/*->with(["article.images"])*/

        $act = News::with(['image'])->where('active', true)->get();

        return response()->json($act);
    }

    public function getAll(Request $request)
    {/*->with(["article.images"])*/
        $act = News::with(['image'])->where('title', 'like', $request->filter . '%')
            ->orWhere('subTitle', 'like', $request->filter . '%')
            ->paginate($request->perPage);

        return response()->json($act);
    }


    public function save(Request $request)
    {


        $input = $request->all();
        $news = new News();

        $news->title = $input['title'];

        if (isset($input['subTitle'])) {
            $news->subTitle = $input['subTitle'];
        }
        if (isset($input['active'])) {
            $news->active = $input['active'];
        }
        DB::transaction(function () use ($input, $news) {
            $news->save();
            $image = $input['image'];
            $img = new Image();
            $news->image()->save($img);
            $tmp = explode('.', $image['name']);
            $name = 'Img' . $img->id . '_' . $news->id . '_name' . '.' . end($tmp);
            $img->src = '/storage/ArticleImages/' . $name;
            $img->name = $name;
            $img->save();
            file_put_contents(storage_path("app/public/ArticleImages/") . '' . $name, base64_decode($image['value']));
        });
        $news->image = $news->image()->first();
        return response()->json(['data' => $news]);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $news = News::findOrFail($input['id']);;

        $news->title = $input['title'];

        if (isset($input['subTitle'])) {
            $news->subTitle = $input['subTitle'];
        }
        if (isset($input['active'])) {
            $news->active = $input['active'];
        }
        DB::transaction(function () use ($input, $news) {
            $news->save();
            if (empty($input['image']['id'])) {
                $image = $input['image'];
                $img = new Image();
                $news->image()->save($img);
                $tmp = explode('.', $image['name']);
                $name = 'Img' . $img->id . '_' . $news->id . '_name' . '.' . end($tmp);
                $img->src = '/storage/ArticleImages/' . $name;
                $img->name = $name;
                $img->save();
                file_put_contents(storage_path("app/public/ArticleImages/") . '' . $name, base64_decode($image['value']));
            }
        });
        $news->image = $news->image()->first();
        return response()->json(['data' => $news]);
    }

    public function delete($id)
    {
        $news = News::find($id);
        $image = $news->image()->first();
        DB::transaction(function () use ($news, $image) {
            if ($news->delete()) {
                Storage::delete('public/ArticleImages/' . $image->name);
            }
        });

        return response()->json(['message' => true]);
    }
}
