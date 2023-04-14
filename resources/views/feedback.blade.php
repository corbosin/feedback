@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @if(Auth::check() && Auth::user()->role == 1)

            <div class="card-header">Связаться с нами</div>



                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                        
                @endif

                <div class="card-body">


    
    
                <form method="post" action="/feedback" enctype="multipart/form-data">
    @csrf
    <label for="theme">Тема сообщения</label><br>
    <input type="text" id="theme" name="theme"><br>

    <label for="message">Your Message:</label><br>
    <textarea id="message" name="message"></textarea><br>

    <label for="attach">Можно добавить файл</label><br>
    <input type="file" id="attach" name="attach"><br>


    <input type="submit" value="Send">
</form>


@endif


@if(Auth::check() && Auth::user()->role == 0)
<div class="container">
    <h1>Обратная связь</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Тема</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Время</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedbacks as $feedback)
            <tr>
                <td>{{$feedback->id}}</td>
                <td>{{$feedback->name}}</td>
                <td>{{$feedback->email}}</td>
                <td>{{$feedback->theme}}</td>
                <td>{{$feedback->message}}</td>
                <td>{{$feedback->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
