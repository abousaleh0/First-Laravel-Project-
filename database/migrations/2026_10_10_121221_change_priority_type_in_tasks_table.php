<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /*public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // نستخدم change() لإخبار لارافيل أننا نعدل عموداً موجوداً ولانقوم بإنشاء واحد جديد
            $table->enum('priority', ['high', 'midium', 'low'])->change();
        });
    }*/

    /* public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // كود التراجع في حال أردنا العودة للنوع القديم
            $table->integer('priority')->change();
        });
    }*/
};
