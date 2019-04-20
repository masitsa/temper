<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePercentageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('percentages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('value');
        });

        DB::table('percentages')->insert([

            ['name' => 'Create Account', 'value' => 0],

            ['name' => 'Activate Account', 'value' => 20],

            ['name' => 'Profile Information', 'value' => 40],

            ['name' => 'Job Interest', 'value' => 50],

            ['name' => 'Work Experience', 'value' => 70],

            ['name' => 'Freelancer Status', 'value' => 90],

            ['name' => 'Pending Approval', 'value' => 99],

            ['name' => 'Approval', 'value' => 100]

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('percentage');
    }
}
