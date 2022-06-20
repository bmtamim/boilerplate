<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->tinyText('address')->nullable()->after('phone');
            $table->tinyText('image')->nullable()->after('address');
            $table->boolean('status')->default(false)->after('remember_token');
            $table->boolean('is_deletable')->default(true)->after('status');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'address', 'status', 'is_deletable', 'image']);
            $table->dropSoftDeletes();
        });
    }
};
