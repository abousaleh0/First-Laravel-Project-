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
        Schema::table('tasks', function (Blueprint $table) {
            // إضافة عمود حالة المهمة، وقيمته الافتراضية false (أي غير منجزة)
            $table->boolean('status')->default(false);

            // تلميح للمحترفين: يمكنك استخدام after لتحديد مكان العمود في قاعدة البيانات
            // $table->boolean('status')->default(false)->after('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // نحذف العمود فقط في حال أردنا التراجع
            $table->dropColumn('status');
        });
    }
};
