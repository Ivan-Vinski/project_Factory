<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Category;
use App\Http\Requests\GetMeals;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MealCollection;

use App;

class MealController extends Controller
{

    // this is the real deal
    public function index(GetMeals $request) {
        $perPage = ($request->get('per_page')) ? $request->get('per_page') : 1 ;
        $page = ($request->input('page')) ? $request->get('page') : 1;
        $diffTime = ($request->input('diff_time') == NULL) ? NULL : date('Y-m-d h:i:s', $request->input('diff_time'));
    
        // lang
        App::setLocale($request->get('lang'));
        $data = Meal::query();

        // tags
        if ($tags = $request->get('tags')){
            foreach($tags as $tag){
                $data->whereHas('tags', function($query) use($tag) {
                    $query->where('tag_id', $tag);
                });
            }
        }

        // category
        if ($category = $request->get('category')) {
            $data->where('category_id', $category);
        }
        
        // diff_time
        if ($diffTime) {
            $data->withTrashed()
                ->where(function($query) use($diffTime){
                    $query->where('created_at', '>=', $diffTime);
                    $query->orWhere('updated_at', '>=', $diffTime);
                    $query->orWhere('deleted_at', '>=', $diffTime);
                });
        }

        // with
        if ($with = $request->get('with')) {
            foreach($with as $w) {
                $data->with($w);
            }
        }

        // paginate
        if ($perPage > 1) {
            return new MealCollection($data->paginate($perPage)
                                            ->withPath($request->fullUrl()));
                                          
        }
        
        return $data->get();

    }
}
