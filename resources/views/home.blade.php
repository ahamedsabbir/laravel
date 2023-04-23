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
					
					@foreach($users as $users_key)
					{{$users_key->name}}
					{{$users_key->update_at}}
					@endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
