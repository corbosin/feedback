<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\Query;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    public function send(Request $request, User $user)
    {
        $user = Auth::user();

        $data = array(
            'name' => $user->name,
            'email' => $user->email,
            'theme' => $request->input('theme'),
            'message' => $request->input('message'),
            'attach' => $request->file('attach'),
        );

         Feedback::create($data);

        Mail::to('manager@mail.ru')->send(new Query($data, $request));

        return redirect('/feedback')->with('status', 'Ваше сообщение отправлено!');
    }

    public function index()
    {
        $feedbacks = Feedback::all();
        return view('feedback', compact('feedbacks'));
    }
}
