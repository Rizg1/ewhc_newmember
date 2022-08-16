<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1516707719MembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('members')) {
            Schema::create('members', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('company')->nullable();
                $table->string('date_avail')->nullable();
                $table->string('provider')->nullable();
                $table->string('type_avail')->nullable();
                $table->string('test')->nullable();
                $table->string('amount')->nullable();
                $table->string('batch_num')->nullable();
                $table->string('check_num')->nullable();
                $table->string('check_am')->nullable();
                $table->string('check_date')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
