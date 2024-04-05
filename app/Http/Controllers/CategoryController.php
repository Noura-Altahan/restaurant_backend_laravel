<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use \App\ReturnResult;
use \App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createCategory(Request $request)
    {
        $result = new ReturnResult();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'required',
            'menu_id' => 'required|numeric',
            'discount' => 'nullable',
        ]);
        if ($validator->fails()) {
            $result->setError403('Please Check all Required Fields');
            return response()->json($result, 403);
        }
        // Create a new category
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->menu_id = $request->menu_id;
        $discount = $request->discount !== null ? $request->discount : 0.0;
        $category->discount_percentage = $discount / 100;

        $category->save();
        $result->data = $category;
        return response()->json($result);
    }
    public function categoriesList(Request $request)
    {
        $result = new ReturnResult();
        $categories = Category::where('is_active', true)
            ->orderBy('id', 'DESC')->get();
        $result->data = $categories;
        return response()->json($result);
    }
}
