<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $all_data = [
            "Software Engineering" => "212",
            "Information Technology" => "213",
            "Computer Science" => "214",
            "Computer Technology" => "215",            
        ];
        $all_units =[
            [
                [
                    "UCU100"=>"HIV & AIDS",
                    "UCU101" => "Communication Skills",
                    "SCS100" => "Computer Architecture",
                    "SCS101" => "Introduction to Computer Programming",
                    "SCS102" => "Discrete Structres",
                    "SIT100" => "Introduction to Computer Applications",
                    "AMM102" => "Mathematics For Sciences"
                ],
                [
                    "SCS103" => "Fundamentals of software engineering",
                    "SIT103" => "Operating systems",
                    "SIT 103" => "Visual Programming"
                ]
                
            ],
            [
                [
                    "AMM103" => "Calculus I",
                    "AMM204" => "Differential and Integral Calculus",                
                    "SCS200" => "Data Structures and Algorithms",                                        
                    "SCS202" => "Object Oriented Programming",                                        
                ],
                [
                    "SCS203" => "Programming and Database Practicum",                    
                    "SCS205" => "Object Oriented Analysis and Design",                    
                    "SCS206" => "Engineering Software Systems",                    
                    "SCS207" => "Software Design and Architecture"                                
                ]
            ],
            [
                [
                    "SCS300" => "Design and Analysis of Algorithms",
                    "SCS303" => "Distributed Systems",
                    "SCS308" => "Open Source Trends",
                    "SIT300" => "Web Application Development",                                        
                    "SIT302" => "Mobile Applications Development",                                        
                ],
                [
                    "SCS301" => "Research Methods in Computing",
                    "SCS302" => "Artificial Intelligence",                                        
                    "SCS307" => "Systems Programming",                                        
                    "SIT304" => "Computer Network Practicum",                                        
                    "SIT305" => "Human Computer Interaction"                                        
                ]
            ],
            [
                [
                    "SCS400" => "Research Project Proposal",
                    "SCS401" => "Knowledge Based Systems",
                    "SCS404" => "Multimedia Systems",
                    "SCS418" => "Business Process Outsourcing",
                    "SIT401" => "ICT Project Management",
                    "SIT402" => "Electronic Commerce"
                ],
                [
                    "SCS410" => "Software Quality Assurance",                                        
                    "SCS412" => "Computer Security and Cryptography",                                        
                    "SCS413" => "Computer Systems Project",                                        
                    "SCS414" => "Machine Learning",                                        
                    "SCS415" => "Industrial Training",                                        
                    "SIT405" => "Professional Practice and Ethics",                                        
                    "SIT409" => "Embedded Systems"                                        
                ]
            ],
        ];
        $year = 0;
        $semester = 0;
        $course_id = 0;
        foreach($all_data as $key=>$value){
            \App\Models\AllCoursesModel::factory()->create(
                [
                    "course_name" => $key,
                    "course_code" => $value,
                ]                
            );
            $course_id+=1;
            foreach($all_units as $row){
                $year += 1;   
                foreach($row as $row_ ){
                    $semester += 1;
                  foreach($row_ as $key_ => $val_){
                    \App\Models\AllUnitsModel::factory()->create(
                        [
                            "unit_name"=>$val_,
                            "unit_code"=>$key_,
                            "year" => $year,
                            "semester"=>$semester,
                            "course_id"=>$course_id
                        ]
                    );
                  }
                }
              }
        }

        
    }
}
