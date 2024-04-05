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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('menu_id');
            $table->float('discount_percentage')->nullable()->default(0.0);
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamps();
        });
        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'Category 1',
            'description' => 'Category 1 description',
            'image' => '',
            'menu_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
