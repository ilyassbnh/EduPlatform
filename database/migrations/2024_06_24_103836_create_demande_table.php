
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeTable extends Migration
{
    public function up()
    {
        Schema::create('demande', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['v', 'nv'])->default('nv');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demande');
    }
}
