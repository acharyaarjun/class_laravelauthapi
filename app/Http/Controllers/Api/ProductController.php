<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Product as ResourcesProduct;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_title' => ['required', 'unique:products,product_title'],
            'product_cost' => ['required', 'numeric'],
            'product_image' => ['required', 'mimes:jpeg,jpg,png,gif'],
            'category_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse($validator->errors(), 'Validation Fail', 400);
        }

        $category_id = $request->input('category_id');
        $category = Category::find($category_id);

        if (is_null($category)) {
            return $this->sendErrorResponse(['category not found'], 'Category with this id doensont exists');
        }

        $latest_product = Product::orderby('id', 'desc')->limit(1)->first();

        $product_title = $request->input('product_title');
        $slug = Str::slug($product_title);
        $product_cost = $request->input('product_cost');
        $product_description = $request->input('product_description');

        $product_image = $request->file('product_image');
        $extension = $product_image->getClientOriginalExtension();
        if (is_null($latest_product)) {
            $product_name = $slug . '.' . $extension;
        } else {
            $product_name = $slug . '-' . $latest_product->id . '.' . $extension;
        }

        $product_image->move('site/uploads/product/', $product_name);

        $product = new Product;
        $product->product_title = $product_title;
        $product->category_id = $category_id;
        $product->slug = $slug;
        $product->product_cost = $product_cost;
        $product->product_description = $product_description;
        $product->product_image = $product_name;
        $product->save();

        return $this->sendSuccessResponse(new ResourcesProduct($product), 'Product Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json("yeuta dekhauni dekhauni function");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json("update dekhauni dekhauni function");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json("delete dekhauni dekhauni function");
    }
}
