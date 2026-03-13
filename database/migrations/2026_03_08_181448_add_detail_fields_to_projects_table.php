<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('hero_video')->nullable()->after('cover_image');       // tanıtım videosu (hero bar)
            $table->string('intro_video')->nullable()->after('hero_video');       // sol kolon loop video
            $table->string('intro_image')->nullable()->after('intro_video');      // sağ kolon büyük görsel
            $table->text('quote_text')->nullable()->after('intro_image');         // alıntı / açıklama metni
            $table->string('hero_image_position')->nullable()->after('quote_text'); // object-position değeri
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'hero_video',
                'intro_video',
                'intro_image',
                'quote_text',
                'hero_image_position',
            ]);
        });
    }
};
