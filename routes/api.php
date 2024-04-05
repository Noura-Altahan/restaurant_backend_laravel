<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Models\Menu;

Route::post('login_admin', [UserController::class, 'loginAdmin']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('categories_list', [CategoryController::class, 'categoriesList']);
    Route::post('create_category', [CategoryController::class, 'createCategory']);

    Route::post('create_sub_category', [SubCategoryController::class, 'createSubCategory']);
    Route::get('sub_categories_list', [SubCategoryController::class, 'subCategoriesList']);


    Route::post('create_item', [ItemController::class, 'createItem']);
    Route::get('items_list', [ItemController::class, 'itemsList']);

    Route::get('menus_list', [MenuController::class, 'menusList']);

    Route::post('logout_admin', [UserController::class, 'logoutAdmin']);
});
