<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('student_adm_nos', function (Blueprint $table) {
            $table->id();
            $table->string("student_no");
            $table->timestamps();
        });
        $data = [
            "SC212/0067/2020",
            "SC212/0068/2021",
            "SC213/0067/2020",
            "SC213/0067/2020",
            "SC214/0067/2020",
            "SC214/0067/2020",
            "SC212/0069/2022",
            "SC212/0070/2019",
        ];
        $stud = new App\Models\StudentAdmNo;
        for($i = 0; count($data); $i++){
            $stud->create(
                [
                    "student_no"=>$data[$i]
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_adm_nos');
    }
};
