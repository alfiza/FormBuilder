<?php
namespace App\Http\Controllers;
use App\Models\Forms;
use Illuminate\Http\Request;

class PublicFormsController extends Controller
{
    public function index()
    {
        $forms = Forms::getForms();
        return view('public_forms.list', ['forms' => $forms]);
    }
    public function showForm($id)
    {
        $form = Forms::find($id);
        $form_arr = json_decode($form->form_json,true);        
        $final_arr['form_fields'] = PublicFormsController::format_array_value($form_arr);    
        $final_arr['form_name'] = $form->name;
        return view('public_forms.showForm', ['form' => $final_arr]);
    }
    public function format_array_value($arr)
    {
        $new_arr = [];
        $i = 0;
        foreach($arr as $val)
        {
            $new_arr[$i][$val['name']] = $val['value'];
            if($val['name']=='field_comment')
                $i++;
        }
        return $new_arr;
    }
}
