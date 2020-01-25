<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class BilibiliVideoQueue extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('bilibili_video_pages', function (Blueprint $table) {
                $table->string('aid')->index()->comment('aid');
                $table->string('cid')->comment('cid');
                $table->string('part')->comment('part');
                $table->unsignedTinyInteger('status')->comment('看CONST.php')->default(STATUS_JOIN_QUEUE);
                $table->unsignedInteger('duration')->comment('时间 秒');

                $table->string('save_url')->nullable()->comment('保存的路径');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
            //
        });
    }
}
