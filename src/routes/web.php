<?php

use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\ResetPasswordMail;


Route::get('/mailtest', function(){

    $usuario = User::find(1);

    $email = Mail::to('lucas.f.pacheco@live.com')->send(new ResetPasswordMail($usuario));






});
