<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100);
            $table->string('subdomain', 100)->nullable();
            $table->string('title', 255);
            $table->string('slug', 191)->unique();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['username', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_categories');
    }
};
