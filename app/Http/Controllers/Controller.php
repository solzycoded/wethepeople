<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // CUSTOM CODE
    public function slug($name, $model, $slug = ""){
        if(is_null($model->id) || ($model->name!==$name && $model->title!==$name)){
            $slug = Str::slug($name . $slug);

            $slugExists = $model->where('slug', 'like', '%' . $slug)->exists();
            if($slugExists){
                return $this->slug($name, $model, Str::random(2));
            }
        }
        else{
            $slug = $model->slug;
        }

        return $slug;
    }
}
