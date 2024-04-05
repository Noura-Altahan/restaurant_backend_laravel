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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('subcategory_id');
            $table->decimal('price', 8, 2);
            $table->float('discount_percentage')->nullable()->default(0.0);
            $table->boolean('is_active')->nullable()->default(true);
            $table->timestamps();
        });
        DB::table('items')->insert([
            'id' => 1,
            'name' => 'item 1',
            'description' => 'item1 description',
            'image' => '',
            'subcategory_id' => 1,
            'price' => 100.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('items')->insert([
            'id' => 2,
            'name' => 'item 2',
            'description' => 'item2 description',
            'image' => '',
            'subcategory_id' => 3,
            'price' => 500.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('items')->insert([
            'id' => 3,
            'name' => 'item 3',
            'description' => 'item3 description',
            'image' => '',
            'subcategory_id' => 2,
            'price' => 200.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
