<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function getCategory(){
        $category = "Category haru xan";
        // return $this->sendSuccessResponse($category, "Category Fetched");      
        return $this->sendErrorResponse($category, "Eroor message!", 401);     
    }
}
