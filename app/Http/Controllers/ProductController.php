<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Image;
use App\Models\Product;
use App\myRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'], ['except' => ['getById', 'get', 'getByListId', 'getNewArrival', 'getOnSale', 'getByListIdWithoutPaginator']]);
    }

    //
    public function getById($id)
    {
        $v = Product::with(["category", "category.subCategories", "article.images", "article.colors", "article.materials"])->find($id);
        if ($v == null)
            return null;
        return response()->json($v);
        // return response()->json($request);
    }


    public function getProductsCompare(Request $request)
    {

    }

    public function getByListIdWithoutPaginator(Request $request)
    {
        $input = $request->all();
        $arr = explode(', ', $input['id']);
        return response()->json(Product::whereIn('id', $arr)->with(["category", "category.subCategories", "article.images", "article.colors", "article.materials", "discount"])->get());
    }

    public function getByName(Request $request)
    {
        return response()->json(Product::where('name', 'like', $request->name . '%')->with(["article.images"])->paginate($request->perPage));
    }

    public function getByListId(Request $request)
    {
        $input = $request->all();
        $arr = explode(', ', $input['id']);
        return response()->json(Product::whereIn('id', $arr)->with(["category", "category.subCategories", "article.images", "article.colors", "article.materials", "discount"])->paginate($request->perPage));
    }

    public function getNewArrival(Request $request)
    {
        $input = $request->all();
        return response()->json(Product::where('created_at', '>', Carbon::now()->subDays(30))->with(["category", "category.subCategories", "article.images", "article.colors", "article.materials", "discount"])->paginate($request->perPage));
    }

    public function getOnSale(Request $request)
    {
        $input = $request->all();
        return response()->json(Product::whereHas('discount')->with(["category", "category.subCategories", "article.images", "article.colors", "article.materials", "discount"])->paginate($request->perPage));
    }

    public function get(Request $request)
    {
        $input = $request->all();


        /*    return response()->json(Product::whereHas('category', function ($query) use ($input) {
                if (isset($input['category_id']) && !empty($input['category_id']))
                    $query->where('id', $input['category_id']);
            })->whereHas('category.subCategories', function ($query) use ($input) {
                if (isset($input['sousCategorie_id']) && !empty($input['sousCategorie_id']))
                    $query->where('id', $input['sousCategorie_id']);
            })->whereHas('article.colors', function ($query) use ($input) {
                if (isset($input['colors_id']) && !empty($input['colors_id'])) {
                    $arr = explode(', ', $input['colors_id']);
                    $query->whereIn('id', $arr);
                }
            })->whereHas('article.materials', function ($query) use ($input) {
                if (isset($input['materials_id']) && !empty($input['materials_id'])) {
                    $arr = explode(', ', $input['materials_id']);
                    $query->whereIn('id', $arr);
                }
            })->with(["category", "category.subCategories", "article.images", "article.colors", "article.materials"])->paginate($request->perPage));
        */
        /*     return response()->json(Product::whereHas('category', function ($query) use ($input) {
                 if (isset($input['category_id']) && !empty($input['category_id']))
                     $query->where('id', $input['category_id']);
                 if (isset($input['sousCategorie_id']) && !empty($input['sousCategorie_id'])) {
                     $query->whereHas('subCategories', function ($query4) use ($input) {
                         $query4->where('id', $input['sousCategorie_id']);
                     });
                 }
             })->whereHas('article', function ($query) use ($input) {

                 if (isset($input['colors_id']) && !empty($input['colors_id'])) {
                     $query->whereHas('colors', function ($query2) use ($input) {
                         $arr = explode(', ', $input['colors_id']);
                         $query2->whereIn('color.id', $arr);
                     });
                 }
                 if (isset($input['materials_id']) && !empty($input['materials_id'])) {
                     $query->whereHas('materials', function ($query3) use ($input) {
                         $arr = explode(', ', $input['materials_id']);
                         $query3->whereIn('material.id', $arr);
                     });
                 }
             })->whereBetween('price', [$input['priceFrom'], $input['priceTo']])->with(["category", "category.subCategories", "article.images", "article.colors", "article.materials"])->paginate($request->perPage));*/
        $prod = Product::whereHas('category', function ($query) use ($input) {
            if (isset($input['category_id']) && !empty($input['category_id']))
                $query->where('id', $input['category_id']);
            if (isset($input['subCategory_id']) && !empty($input['subCategory_id'])) {
                $query->whereHas('subCategories', function ($query4) use ($input) {
                    $query4->where('id', $input['subCategory_id']);
                });
            }
        })->whereHas('article', function ($query) use ($input) {
//            $query->where('stock', '>', 0);
            if (isset($input['colors_id']) && !empty($input['colors_id'])) {
                $query->whereHas('colors', function ($query2) use ($input) {
                    $arr = explode(', ', $input['colors_id']);
                    $query2->whereIn('color.id', $arr);
                });
            }
            if (isset($input['materials_id']) && !empty($input['materials_id'])) {
                $query->whereHas('materials', function ($query3) use ($input) {
                    $arr = explode(', ', $input['materials_id']);
                    $query3->whereIn('material.id', $arr);
                });
            }
        });
        if (isset($input['priceFrom']) && !empty($input['priceFrom'])) {
            $prod->whereBetween('price', [$input['priceFrom'], $input['priceTo']]);
        }
        return response()->json($prod->with(["category", "category.subCategories", "article.images", "article.colors", "article.materials", "discount"])->paginate($request->perPage));

//        return response()->json(explode(', ', $input['colors_id']));
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $article = Article::findOrFail($input['article']['id']);
        $article->init2($input['article']);
        if (isset($input['article']['colors']))
            $colors = $input['article']['colors'];
        if (isset($input['article']['materials']))
            $materials = $input['article']['materials'];
        $product = Product::findOrFail($input['id']);
        $product->init2($input);
        $product->id = $input['id'];
        $product->save();

        $article->product()->associate($product);
        $article->save();
        if (isset($input['article']['colors']))
            $article->colors()->sync($colors);
        if (isset($input['article']['materials']))
            $article->materials()->sync($materials);
        if (isset($input['article']['images'])) {
            $images = $input['article']['images'];
            foreach ($images as $image) {
                if (!isset($image['id']) || empty($image['id'])) {
                    $img = new Image();
                    $article->images()->save($img);
                    $tmp = explode('.', $image['name']);
                    $name = 'Img' . $img->id . '_' . $article->id . '_name' . '.' . end($tmp);
                    $img->src = '/storage/ArticleImages/' . $name;
                    $img->name = $name;
                    $img->save();
                    file_put_contents(storage_path("app/public/ArticleImages/") . '' . $name, base64_decode($image['value']));
                }
            }
        }
        return response()->json($article->id);
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $article = Article::init($input['article']);
        $colors = $input['article']['colors'];
        $materials = $input['article']['materials'];


        $product = Product::init($input);
        $product->save();

        $article->product()->associate($product);
        $article->save();

        $article->colors()->sync($colors);
        $article->materials()->sync($materials);

        if (isset($input['article']['images'])) {
            $images = $input['article']['images'];
            foreach ($images as $image) {
                $img = new Image();
                $article->images()->save($img);
                $tmp = explode('.', $image['name']);
                $name = 'Img' . $img->id . '_' . $article->id . '_name' . '.' . end($tmp);
                $img->src = '/storage/ArticleImages/' . $name;
                $img->name = $name;
                $img->save();
                file_put_contents(storage_path("app/public/ArticleImages/") . '' . $name, base64_decode($image['value']));

            }
        }
        return response()->json($article->id);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $article = $product->article()->first();
        $images = $article->images()->get();
        DB::transaction(function () use ($images, $product) {
            //
            if ($product->delete()) {
                foreach ($images as $image) {
                    Storage::delete('public/ArticleImages/' . $image->name);
                }
            }
        });


        return response()->json(['message' => true]);
    }

    public function deleteImage($id, $name)
    {
        /* Storage::put('public/file2.txt', 'text');
         Storage::delete('public/file2.txt');*/
        Image::find($id)->delete();
        Storage::delete('public/ArticleImages/' . $name);
        return response()->json(['message' => true]);
    }
}
