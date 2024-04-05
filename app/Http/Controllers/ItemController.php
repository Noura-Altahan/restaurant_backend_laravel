<?php

namespace App\Http\Controllers;

use \App\ReturnResult;
use \App\Models\Subcategory;
use App\Models\SubcategorySubcategory;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function createItem(Request $request)
    {
        $result = new ReturnResult();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'required',
            'price' => 'required',
            'sub_category_id' => 'required|numeric',
            'discount' => 'nullable',
        ]);
        if ($validator->fails()) {
            $result->setError403('Please Check all Required Fields');
            return response()->json($result, 403);
        }
        // check level
        $query = SubcategorySubcategory::where('parent_subcategory_id', $request->sub_category_id)->first();
        if ($query) {
            $result->setError("It is not possible for a subcategory and an item to be at the same level within the hierarchy.", "ERROR");
            return response()->json($result, 404);
        }
        // Create a new Item
        $subcategory = SubCategory::where('id', $request->sub_category_id)->first();
        $item = new Item();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->subcategory_id = $request->sub_category_id;
        $discount = $request->discount ? ($request->discount / 100) : ($subcategory->discount_percentage);
        $item->discount_percentage = $discount;
        $item->save();

        $result->message = 'Created Successfully';
        return response()->json($result);
    }
    public function itemsList(Request $request)
    {
        $result = new ReturnResult();
        $item = Item::where('is_active', true)
            ->orderBy('id', 'DESC')->get();
        $result->data = $item;
        return response()->json($result);
    }
}
