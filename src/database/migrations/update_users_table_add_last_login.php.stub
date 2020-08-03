<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableAddLastLogin extends Migration
{

    public function up()
    {
        if (Schema::hasTable(config('kpi.users_table_name'))) {
            Schema::table(config('kpi.users_table_name'), function (Blueprint $table) {
                $table->timestamp(config('kpi.last_login_column_name'))->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable(config('kpi.users_table_name'))) {
            Schema::table(config('kpi.users_table_name'), function (Blueprint $table) {
                $table->dropColumn(config('kpi.last_login_column_name'));
            });
        }
    }
}