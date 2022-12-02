<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function getCategory(){
        $response = [
            'success' => true,
            'data' => [
                'category1',
                'category2'
            ],
            'message' => 'Category fetchded successulyy!'
        ];
        return response()->json([
            'success' => true,
            'data' => [
                'category1',
                'category2'
            ],
            'message' => 'Category fetchded successulyy!'
        ], 200);
    }
}
