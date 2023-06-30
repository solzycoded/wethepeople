<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Status;

class StatusController extends Controller
{
    // READ
    public function find($id){
        return Status::find($id);
    }

    // OTHERS
    public function checkStatus($statusId, $name){
        return $this->find($statusId)->name==$name;
    }
}
