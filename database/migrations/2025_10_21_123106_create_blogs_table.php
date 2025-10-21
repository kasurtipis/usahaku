<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Jalankan migrasi.
	 */
	public function up(): void
	{
		Schema::create('blogs', function (Blueprint $table) {
			$table->id(); // id utama
			$table->string('slug', 191)->unique();
			$table->string('subdomain', 100)->nullable();
			$table->string('username', 100);
			$table->string('title', 255);

			// Relasi
			$table->foreignId('blog_category_id')
				->nullable()
				->constrained('blog_categories')
				->nullOnDelete()
				->cascadeOnUpdate();

			$table->string('author', 150)->nullable();
			$table->longText('content');
			$table->string('meta_title', 255)->nullable();
			$table->string('meta_description', 255)->nullable();
			$table->unsignedInteger('visitor')->default(0);
			$table->string('tag', 255)->nullable();

			// Soft delete Laravel-style (lebih fleksibel)
			$table->softDeletes();

			// Timestamps otomatis
			$table->timestamps();

			// Index tambahan untuk optimasi pencarian
			$table->index(['username']);
			$table->index(['slug', 'username']); // slug unik per user
		});
	}

	/**
	 * Rollback migrasi.
	 */
	public function down(): void
	{
		Schema::dropIfExists('blogs');
	}
};
