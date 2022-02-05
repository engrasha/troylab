<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\School;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->integer('status')->default(0);  
            $table->integer('exam_assgin')->default(0);            
            $table->integer('order');  
            $table->string('username')->unique();
            $table->string('password');            
           // $table->foreignId('school_id');
            $table->foreignIdFor(School::class);
            $table->softDeletes($column = 'deleted_at', $precision = 0);        
            $table->text('remember_token'); //rememberToken();
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
        Schema::dropIfExists('students');
    }
}
