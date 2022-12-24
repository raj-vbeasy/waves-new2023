<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('contracts', 'name')) {
            Schema::table('contracts', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }
        Schema::table('contracts', function (Blueprint $table) {
            $table->string('first_name')->after('id');
            $table->string('last_name')->nullable()->after('first_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name']);
        });
    }
}
