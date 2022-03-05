<?php

namespace Database\Seeders;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FomrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('forms')->insert([[
            'name' => "Student Form",
            'form_json' => '[{"name":"field_name","value":"f name"},{"name":"field_type","value":"text"},{"name":"field_drop_options","value":null},{"name":"field_comment","value":"enter name"},{"name":"field_name","value":"l name"},{"name":"field_type","value":"text"},{"name":"field_drop_options","value":null},{"name":"field_comment","value":"enter name"},{"name":"field_name","value":"class"},{"name":"field_type","value":"select"},{"name":"field_drop_options","value":"class 1,class 2,class 3"},{"name":"field_comment","value":"select"},{"name":"field_name","value":"mo. no."},{"name":"field_type","value":"number"},{"name":"field_drop_options","value":null},{"name":"field_comment","value":"enter no."}]',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => "1",
            'updated_by' => "1"

        ],[
            'name' => "EMP Class Form",
            'form_json' => '[{"name":"field_name","value":"Name"},{"name":"field_type","value":"text"},{"name":"field_drop_options","value":null},{"name":"field_comment","value":"Student Name"},{"name":"field_name","value":"Phone No"},{"name":"field_type","value":"number"},{"name":"field_drop_options","value":null},{"name":"field_comment","value":"Phone Number"},{"name":"field_name","value":"Gender"},{"name":"field_type","value":"select"},{"name":"field_drop_options","value":"Female,Male"},{"name":"field_comment","value":"Select  Detail"},{"name":"field_name","value":"Extra note"},{"name":"field_type","value":"text"},{"name":"field_drop_options","value":null},{"name":"field_comment","value":"Extra notes"}]',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => "1",
            'updated_by' => "1"

        ],[
            'name' => "Student Details Form",
            'form_json' => '[{"name":"field_name","value":"first name"},{"name":"field_type","value":"text"},{"name":"field_drop_options","value":null},{"name":"field_comment","value":"enter first name"},{"name":"field_name","value":"last name"},{"name":"field_type","value":"text"},{"name":"field_drop_options","value":null},{"name":"field_comment","value":"enter last name"},{"name":"field_name","value":"gender"},{"name":"field_type","value":"select"},{"name":"field_drop_options","value":"Female,Male,"},{"name":"field_comment","value":"select gender"},{"name":"field_name","value":"contact no"},{"name":"field_type","value":"number"},{"name":"field_drop_options","value":null},{"name":"field_comment","value":"enter contact no"},{"name":"field_name","value":"class no."},{"name":"field_type","value":"select"},{"name":"field_drop_options","value":"class1,class2,class3"},{"name":"field_comment","value":"select class"}]',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_by' => "1",
            'updated_by' => "1"

        ]

    ]);
    }
}
