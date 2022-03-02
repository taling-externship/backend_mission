<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('original_name');
            $table->string('stored_name');
            $table->foreignId('article_id')->constrained('articles', 'id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attachments', function ($table) {
            if (config('app.env') !== 'testing') {
                $table->dropForeign(['article_id']);
            }
        });
        Schema::dropIfExists('attachments');
    }
}
