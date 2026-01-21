<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id(); // id
            $table->string('title'); // Front-end Development
            $table->text('description'); // Service description
            $table->enum('icon',['code' , 'ui&ux', 'database' , 'web','iot','mobile','hardware' , 'backend', 'frontend'])->default('code'); // frontend, backend, iot...

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
