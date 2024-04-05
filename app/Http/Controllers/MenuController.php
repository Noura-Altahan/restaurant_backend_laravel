<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use \App\ReturnResult;
use \App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function menusList(Request $request)
    {
        $result = new ReturnResult();
        $menus = Menu::where('is_active', true)
            ->orderBy('id', 'DESC')->get();;
        $result->data = $menus;
        return response()->json($result);
    }
}
