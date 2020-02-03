<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScholarshipGrants extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        // Schema To be Delete
        
        
        
        
        
        
        
        
        
        
        
        Schema::create('scholarship_grants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('id')->references('id')->on('registerusers')->onDelete('cascade');

            $table->enum('scholarshipGranted', ['yes', 'no'])->default('no');
            $table->string('scholarshipName')->default('null');
            $table->date('yearOfScholarshipGrant')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('scholarship_grants');
    }

}
