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
    Schema::table('staff', function (Blueprint $table) {
        $table->string('name')->nullable();
        $table->string('email')->nullable()->unique();
        $table->string('password')->nullable();
        $table->string('role')->nullable();
        $table->string('phone_number')->nullable()->unique();
    });

    Schema::table('staff', function (Blueprint $table) {
        $table->string('name')->nullable(false)->change();
        $table->string('email')->nullable(false)->change();
        $table->string('password')->nullable(false)->change();
        $table->string('role')->nullable(false)->change();
        $table->string('phone_number')->nullable(false)->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('staff', function (Blueprint $table) {
        $table->dropUnique(['email']);
        $table->dropUnique(['phone_number']);

        $table->dropColumn([
            'name',
            'email',
            'password',
            'role',
            'phone_number',
        ]);
    });
}
};
