<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToUsersTable extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('image_url')->nullable();  // столбец для изображения
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('image_url');  // удаляем столбец, если миграция откатывается
    });
}


}
