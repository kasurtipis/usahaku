<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')
                  ->constrained('blogs')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            
            $table->string('username', 100);
            $table->string('subdomain', 100)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('slug', 191)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->text('content');
            $table->unsignedBigInteger('reply')->nullable()
                  ->comment('id komentar yang dibalas');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('reply')->references('id')->on('blog_comments')->nullOnDelete();
            $table->index(['blog_id', 'username']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
    }
};
