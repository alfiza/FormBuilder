<?php
namespace App\Http\Controllers\Admin;
use App\Models\Forms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class FormsController extends Controller
{
    public function index()
    {
        $forms = Forms::getForms();
        return view('forms.list', ['forms' => $forms]);
    }
    public function create()
    {
            return view('forms/create_edit');
    }
    public function store(Request $req)
    {
        $forms = new Forms();
        $arr = $forms->addForm($req);
        return $arr;
    }
    public function edit($id)
    {
        $form = Forms::find($id);
        $form_arr = json_decode($form->form_json,true);        
        $final_arr['form_fields'] = \App\Http\Controllers\PublicFormsController::format_array_value($form_arr);    
        $final_arr['form_id'] = $form->id;
        $final_arr['form_name'] = $form->name;
        return view('forms.create_edit', ['forms' => $final_arr]);
             
    }
    public function update(Request $req)
    {
        $forms = new Forms();
        $arr = $forms->updateForm($req);
        return $arr;
    }
    public function destroy($id)
    {
        $form = Forms::find($id);
        if($form->delete())
        {
            $arr['status'] = "success";
            $arr['msg'] = "Form deleted successfully...";
            
        }
        else
        {
            $arr['status'] = "error";
            $arr['msg'] = "Something went wrong...";
        }
        return $arr;
    }
}
