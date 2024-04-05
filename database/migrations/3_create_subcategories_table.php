<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->float('discount_percentage')->nullable()->default(0.0);
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamps();
        });
        DB::table('subcategories')->insert([
            'id' => 1,
            'name' => 'subCategory 1',
            'description' => 'subCategory 1 description',
            'image' => '',
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('subcategories')->insert([
            'id' => 2,
            'name' => 'subCategory 2',
            'description' => 'subCategory 2 description',
            'image' => '',
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('subcategories')->insert([
            'id' => 3,
            'name' => 'subCategory 3',
            'description' => 'subCategory 3 description',
            'image' => '',
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
