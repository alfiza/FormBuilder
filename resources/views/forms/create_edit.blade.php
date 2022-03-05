 @extends('layouts.app')

@section('content')
<style>
    .validate_td{border:2.5px solid red;}
    .modal-dialog{left: 0%;}
    .option_field{width: 300px} 
    .curser_pointer{cursor: pointer}
</style>

<div class="modal" id="add_drop_option_div" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Dropdown options list</h5>
            
            <span class='btn btn-danger a-btn-slide-text glyphicon glyphicon-remove' aria-hidden='true' onClick="$('#add_drop_option_div').modal('hide')"></span>
        </div>
        <div class="modal-body">
            <a href="javascript:void(0)" class="btn btn-secondary a-btn-slide-text" id="addOptionsBtn"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span><span><strong>Add More</strong></span></a>
            <br><br>
            <input class='option_list_input form-control option_field' type='text'>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="OptionSubmitBtn" data-dismiss="modal" id='delete-btn-conf'>Submit</button>
            <button type="button" class="btn btn-secondary" onClick="$('#add_drop_option_div').modal('hide')">Cancle</button>
        </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form id="form_builder"> 
                    <div class="card-header">{{ 'Create Form' }}</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Form Name:</label>
                            <div class="col-sm-3">
                                <input type="text" value='{{@$forms["form_name"]}}' class="form-control" id="formName" placeholder="Form Name">
                                
                            </div>
                        </div>
                        <table class="table validate_table" id="field_list_table"> 
                            <thead>
                                <tr>
                                    <th scope="col" width="20%">Field Label/Name</th>
                                    <th scope="col" width="15%">HTML Field</th>
                                    <th scope="col" width="15%">Dropdown options</th>
                                    <th scope="col" width="25%">Comment</th>
                                    <th scope="col" width="5%">
                                        <a href="javascript:void(0)" class="btn btn-secondary a-btn-slide-text" onclick="addMoreField()">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                            <span><strong>Add More</strong></span>            
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($forms))
                                @if(!empty($forms))
                                    @for($i=0;$i<count($forms['form_fields']);$i++)

                                    <tr id='row{{$i}}' data-sr_no='{{$i}}'>
                                        <td>
                                            <input id='field_name{{$i}}' value="{{$forms['form_fields'][$i]['field_name']}}" class='form-control' name='field_name' max-length='100' required='required' type='text'>
                                        </td>
                                        <td>
                                            @php $type = $forms['form_fields'][$i]['field_type']; @endphp
                                            <select  onChange='showDropOptions({{$i}})' id='field_type{{$i}}' class='form-control ' name='field_type' required='required' >
                                                <option value=''>Select</option>
                                                <option value='text' {{($type=='text'?"selected":"")}}>Text</option>
                                                <option value='number' {{($type=='number'?"selected":"")}}>Number</option>
                                                <option value='select' {{($type=='select'?"selected":"")}}>Drop Down</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type='text' readonly class='form-control curser_pointer' onclick='showDropOptions({{$i}})' value="{{$forms['form_fields'][$i]['field_drop_options']}}" name='field_drop_options' id='field_drop_options{{$i}}' >
                                        </td>
                                        <td>
                                            <input id='field_comment{{$i}}' class='form-control' name='field_comment' type='text' value="{{$forms['form_fields'][$i]['field_comment']}}" required='required' max-length='500'>
                                        </td>
                                        <td>
                                            <span class='btn btn-danger a-btn-slide-text glyphicon glyphicon-remove' aria-hidden='true' onclick="+del_row+"></span>
                                        </td>
                                    </tr>
                                    
                                    @endfor
                                @else 
                                    <tr>
                                        <td colspan='5' align="center"> No Record Found!</th>
                                    </tr>
                                @endif 
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="button" onclick="submitForm({{@$forms['form_id']}})" class="btn btn-secondary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
var sr_no=<?php if(isset($forms)){echo $i-1;}else{echo "1";} ?>;    
var CSRF_TOKEN = '{{ csrf_token() }}';
var is_edit = '{{ isset($forms) }}';

$(function() {
    $('body').on('blur', '.form-control', function() {
        $(".validate_td").removeClass("validate_td");
    });
    if(is_edit=='')
        addMoreField(); 
});
function addMoreField(){
    validate_last_field = validateForm();
    if(validate_last_field)
    {
        sr_no++;
        var del_row = 'removeFDRow('+sr_no+');';
        var row = "<tr id='row"+sr_no+"' data-sr_no='"+sr_no+"'><td><input id='field_name"+sr_no+"' class='form-control' name='field_name' max-length='100' required='required' type='text'></td><td><select  onChange='showDropOptions("+sr_no+")' id='field_type"+sr_no+"' class='form-control ' name='field_type' required='required' ><option value=''>Select</option><option value='text'>Text</option><option value='number'>Number</option><option value='select'>Drop Down</option></select></td><td><input type='text' readonly class='form-control curser_pointer' onclick='showDropOptions("+sr_no+")' name='field_drop_options' id='field_drop_options"+sr_no+"' ></td><td><input id='field_comment"+sr_no+"' class='form-control' name='field_comment' type='text' required='required' max-length='500'></td><td><span class='btn btn-danger a-btn-slide-text glyphicon glyphicon-remove' aria-hidden='true' onclick="+del_row+"></span></td></tr>";
        $("#field_list_table").append(row);
    }
}
function addOption(sr_no){
    
    var option_str = jQuery("<input class='option_list_input option_field form-control'  type='text'>");
    $(".option_list_input").last().after(option_str);
}
function addOptionSubmit(sr_no){
    
    var option_list_input=[];option_list_input_val = "";
    $('.option_list_input').each(function() {
        option_list_input.push($(this).val());
        option_list_input_val+=$(this).val().replace(" ","");
    });
    if(option_list_input=='' || option_list_input_val=='')
    {
        $("#info_msg").html("Atleast one Option field is required.");
        $("#info_div").modal("show");
        return false;
    }
    else
    {
        $("#field_drop_options"+sr_no).val((option_list_input.toString()));
        $("#add_drop_option_div").modal("hide");
    }
}
function validateForm()
{
    validate_last_field = true;
    if($( ".validate_table" ).length )
    {
        $(".validate_td").removeClass("validate_td");
        $("#field_list_table select").each(function( index ) {
            if($(this).val()=='' || $(this).val()==null)
            {
                $(this).addClass("validate_td");
                validate_last_field = false;
                return false;
            }
        });
        $("#field_list_table input:not([readonly]").each(function( index ) {
            if($(this).val()=='' || $(this).val()==null)
            {
                $(this).addClass("validate_td");
                validate_last_field = false;
                return false;
            }
        });
    }
    return validate_last_field;
}
function removeFDRow(id)
{
    $("#delete_confirm_div").modal("show");
    $("#delete_confirm_div #delete-btn-conf").attr("onclick","deleteConfirmFDROW('"+id+"')");
}
function deleteConfirmFDROW(id)
{
    $("#row"+id).remove();
    $("#delete_confirm_div").modal("hide");
}
function showDropOptions(sr_no)
{
    if($("#field_type"+sr_no).val()=='select')
    {
        $(".option_list_input:not(:first)").remove();
        $(".option_list_input").val("");
        $('#addOptionsBtn').attr("onclick","addOption('"+sr_no+"')");
        $('#OptionSubmitBtn').attr("onclick","addOptionSubmit('"+sr_no+"')");
        $("#add_drop_option_div").modal("show");    
    }
    else
    {
        $("#field_drop_options"+sr_no).val("");
    }
}
function submitForm(edit_id='')
{
    if($("#formName").val()=='')
    {
        $("#formName").addClass("validate_td");   
        return false;
    }
    else if($(".validate_table" ).length <=0)
    {
        $("#info_msg").html("Atleast one Form field is required.");
        $("#info_div").modal("show");
        return false;
    }
    if(validateForm())
    {
        if(edit_id!='')
        {
            $.ajax({
                    type: "POST",
                    url: '{{url("")}}/forms/'+edit_id,
                    data: { 
                           _token: CSRF_TOKEN,
                           form_name:$("#formName").val(),
                           _method:"PUT",
                           form_json:$("#form_builder").serializeArray(),
                           id:edit_id
                       },
                    success: function (data) {  
                        if(data != '')
                        {   
                            $("#info_msg").html(data['msg']);
                            $("#info_popup_btn").attr("onclick","window.location.href=\"{{url('/forms')}}\"");
                            $("#info_div").modal("show");
                        }
                    }
                });  
        }
        else
        {
            $.ajax({
                    type: "POST",
                    url: '{{url('')}}/forms',

                    data: { 
                           _token: CSRF_TOKEN,
                           form_name:$("#formName").val(),
                           form_json:$("#form_builder").serializeArray()
                       },
                    success: function (data) {  
                        if(data != '')
                        {   
                            $("#info_msg").html(data['msg']);
                            $("#info_popup_btn").attr("onclick","window.location.href=\"{{url('/forms')}}\"");
                            $("#info_div").modal("show");
                        }
                    }
                });  
        }
    }
}
</script>
@endsection
