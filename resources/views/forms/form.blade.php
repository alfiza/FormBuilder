 @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <br/><br/>
                    <h2>Welcome to Admin Dashboard</h2>

                </div>
                <button type="button" class="btn btn-dark">Create Form</button>
            </div>
        </div>
    </div>
</div>
@endsection
