<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('category')->after('user_id');
            $table->string('customer_name')->after('category');
            $table->string('phone')->after('customer_name');
            $table->string('table_number')->after('phone');
            $table->string('attachment')->nullable()->after('content'); // untuk file upload
        });
    }

    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn(['category', 'customer_name', 'phone', 'table_number', 'attachment']);
        });
    }
};