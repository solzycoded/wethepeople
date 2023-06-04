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
        $slug = Str::slug($name . $slug);

        $slugExists = $model->where('slug', 'like', '%' . $slug)->exists();
        if($slugExists){
            return $this->slug($name, $model, $slug);
        }

        return $slug;
    }
}
