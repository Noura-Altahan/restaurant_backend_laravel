<?php

namespace App\Http\Controllers;

use App\Models\Category;
use \App\ReturnResult;
use \App\Models\Subcategory;
use App\Models\SubcategorySubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function createSubCategory(Request $request)
    {
        $result = new ReturnResult();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'required',
            'category_id' => 'required|numeric',
            'sub_category_id' => 'nullable|numeric',
            'discount' => 'nullable',
        ]);
        if ($validator->fails()) {
            $result->setError403('Please Check all Required Fields');
            return response()->json($result, 403);
        }
        // check if The subcategory hierarchy has a depth greater than four levels
        $count = 0;
        if ($request->sub_category_id) {
            $parent = $request->sub_category_id;
            while ($parent != 0) {
                $count++;
                $query = SubcategorySubcategory::where('child_subcategory_id', $parent)->first();
                if ($query) {
                    $parent = $query->parent_subcategory_id;
                } else {
                    break;
                }
            }
        }

        if ($count > 3) {
            $result->setError("The subcategory hierarchy has a depth greater than four levels");
            return response()->json($result, 404);
        }

        $category = Category::where('id', $request->category_id)->first();
        DB::transaction(function () use ($request, $category) {
            // Create a new sub-category
            $subCategory = new SubCategory();
            $subCategory->name = $request->name;
            $subCategory->description = $request->description;
            $subCategory->category_id = $request->category_id;

            $discount = $request->discount ? ($request->discount / 100) : ($category->discount_percentage);
            $subCategory->discount_percentage = $discount;
            $subCategory->save();

            $sub_Category = new SubcategorySubcategory();
            $sub_Category->parent_subcategory_id = $request->sub_category_id ? $request->sub_category_id : 0;
            $sub_Category->child_subcategory_id = $subCategory->id;
            $sub_Category->save();
        });
        $result->message = 'Created Successfully';
        return response()->json($result);
    }
    public function subCategoriesList(Request $request)
    {
        $result = new ReturnResult();
        $categories = SubCategory::where('is_active', true)
            ->orderBy('id', 'DESC')->get();
        $result->data = $categories;
        return response()->json($result);
    }
}
