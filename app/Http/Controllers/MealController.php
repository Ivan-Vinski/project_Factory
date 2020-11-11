<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Http\Requests\GetMeals;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MealCollection;

use App;

class MealController extends Controller
{
    public function index(GetMeals $request) 
    {
        // Set language for all data returned
        App::setLocale($request->get('lang'));

        $data = Meal::query();
        // Filter data based on 'tags'
        if ($request->get('tags')) {
            $tags = explode(',', $request->get('tags'));
            foreach($tags as $tag){
                $data->whereHas('tags', function($query) use($tag) {
                    $query->where('tag_id', $tag);
                });
            }
        }

        // Filter data based on 'category_id'
        if ($category = $request->get('category')) {
            if ($category == 'null' || $category == 'NULL') {
                $data->where('category_id', NULL);
            }
            else if ($category == '!null' || $category == '!NULL') {
                $data->where('category_id', '!=', NULL);
            }
            else {
                $data->where('category_id', $category);
            }
        }
        
        // Filter data based on 'diff_time'
        $diffTime = ($request->input('diff_time') == NULL) ? NULL : date('Y-m-d h:i:s', $request->input('diff_time'));
        if ($diffTime) {
            $data->withTrashed()
                ->where(function($query) use($diffTime){
                    $query->where('created_at', '>=', $diffTime);
                    $query->orWhere('updated_at', '>=', $diffTime);
                    $query->orWhere('deleted_at', '>=', $diffTime);
                });
        }

        // Add additional data (tags/ingredients/category)
        if ($request->get('with')) {
            $with = explode(',', $request->get('with'));
            foreach($with as $w) {
                $data->with($w);
            }
        }

        // Add pagination
        $perPage = ($request->get('per_page')) ? $request->get('per_page') : $data->count();
        return new MealCollection($data->paginate($perPage)->withPath($request->fullUrl()));
                                          
     
      
    }
}
