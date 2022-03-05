 @extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <form > 
                    <div class="card-header"><h3><b>Form : {{ ucwords($form['form_name']) }}</b></h3></div>
                  
                    <div class="card-body">
                        @for($i=0;$i<count($form['form_fields']);$i++)
                            <div class="form-group row">
                                @php 
                                    $f_name = $form['form_fields'][$i]['field_name'];
                                    $f_type = $form['form_fields'][$i]['field_type'];
                                    $f_comment = $form['form_fields'][$i]['field_comment'];
                                @endphp
                                <label for="staticEmail" class="col-sm-2 col-form-label">{{ucfirst($f_name)}}:</label>
                                <div class="col-sm-4">
                                    
                                    @if($f_type=='select')
                                        <select name="{{$f_name}}" class="form-control">
                                            <option value="">Select</option>
                                            @php $option_arr = explode(",",trim($form['form_fields'][$i]['field_drop_options'],",")); @endphp
                                            @foreach($option_arr as $val)
                                                @if($val!='')
                                                <option value="{{strtolower(str_replace(' ', '_', $val))}}">{{$val}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @else

                                    <input type="{{$f_type}}" name="{{$f_name}}" class="form-control" placeholder="{{$f_comment}}">  
                                    @endif
                                </div>
                            </div>        
                        @endfor
                    </div>
                    <div class="card-footer">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
