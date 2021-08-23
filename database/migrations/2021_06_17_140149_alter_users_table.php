<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'first_name');
            $table->string('last_name')->after('name');
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null')->after('remember_token');
            $table->foreignId('primary_company')->nullable()->constrained('companies')->onDelete('set null')->after('role_id');
            $table->unsignedTinyInteger('active')->default(0)->after('primary_company');
            $table->unsignedTinyInteger('is_contact')->default(0)->after('active');
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
            $table->renameColumn('first_name', 'name');
            $table->dropColumn('last_name');
            $table->dropColumn('role_id');
            $table->dropColumn('primary_company');
            $table->dropColumn('active');
            $table->dropColumn('is_contact');
        });
    }
}
