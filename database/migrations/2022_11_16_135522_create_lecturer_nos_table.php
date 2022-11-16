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
        Schema::create('lecturer_nos', function (Blueprint $table) {
            $table->id();
            $table->string("employee_no");
            $table->timestamps();
        });
        $data_emp = [
            "LE213/2300/2020",
            "LE213/2301/2020",
            "LE213/2302/2021",
            "LE213/2303/2022",
            "LE213/2304/2021",
            "LE213/2305/2021",
            "LE213/2306/2021",
            "LE213/2307/2020",
        ];
        $emp = new App\Models\LecturerNo;
        for ($i = 0; count($data_emp); $i++){
            $emp->create(
                [
                    "employee_no" => $data_emp[$i]
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
        Schema::dropIfExists('lecturer_nos');
    }
};
