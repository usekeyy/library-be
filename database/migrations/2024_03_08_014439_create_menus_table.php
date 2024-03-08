<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->default(DB::raw('uuid_generate_v4()'));
            $table->string('name');
            $table->string('description')->nullable();
            $table->bigInteger('permission_id');
            $table->foreign('permission_id')
                    ->references('id')
                    ->on('permissions');
            $table->string('url')->default('#');
            $table->integer('order_no')->default('0');
            $table->string('icon')->nullable();
            $table->integer('parent_id')->default('0');
            $table->char('status', 1)->default('y');
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
