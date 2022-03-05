<?php

namespace App\Models;
use App\User;
use App\Updater;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Forms extends Model
{
    use Updater;
    use HasFactory;
    use SoftDeletes;
    public function getForms()
    {
        $forms = Forms::get();
        return $forms;
    }
    public function addForm($req)
    {
        $forms = new Forms();
        $forms->name = $req->form_name;
        $forms->form_json = json_encode($req->form_json);
        if($forms->save())
        {
            $arr['status'] = "success";
            $arr['msg'] = "Form submited successfully...";
            
        }
        else
        {
            $arr['status'] = "error";
            $arr['msg'] = "Something went wrong...";
        }
        return $arr;
    }
    public function updateForm($req)
    {
        $forms = Forms::find($req->id);
        $forms->name = $req->form_name;
        $forms->form_json = json_encode($req->form_json);
        if($forms->save())
        {
            $arr['status'] = "success";
            $arr['msg'] = "Form updated successfully...";
            
        }
        else
        {
            $arr['status'] = "error";
            $arr['msg'] = "Something went wrong...";
        }
        return $arr;
    }
    
}
