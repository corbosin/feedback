@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
@if(Auth::check() && Auth::user()->role == 0)
<div class="card-header">Заявки</div>


@foreach($feedbacks as $feedback)
<div>{{ $feedback->name }}</div>
    <div>{{ $feedback->email }}</div>
    <div>{{ $feedback->theme }}</div>
    <div>{{ $feedback->message }}</div>
@endforeach


@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
