<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Thinkcreative\Contact\TCModule;

class ModulesTableFromContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('modules')) {

            Schema::create('modules', function (Blueprint $table) {

                $table->bigIncrements('id');
                $table->string('name')->unique();
                $table->boolean('show_in_menu');
                $table->timestamps();

            });
        }
        
        TCModule::AddModule('contact');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('modules');
        
        TCModule::DropModule('contact');
    }
}
