@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>{{ 'Forms List' }}</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="30%">Form Name</th>
                                <th scope="col" width="40%">Created At</th>
                                <th scope="col" width="25%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($forms))
                            @php $i=1; @endphp
                            @foreach($forms as $val)
                            <tr>
                                <td>{{$i}}</th>
                                <td>{{$val->name}}</td>
                                <td>{{date('d/m/Y H:i:s',strtotime($val->created_at))}}</td>
                                <td>
                                    <a href='{{ url("/showForm/$val->id") }}' class="btn btn-primary a-btn-slide-text" >
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                        <span><strong>View</strong></span>            
                                    </a>
                                </td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan='4'  align="center"> No Record Found!</th>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
