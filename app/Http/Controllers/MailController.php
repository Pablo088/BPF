<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function enviarCorreoPrueba()
    {
        Mail::to('destinatario@ejemplo.com')->send(new TestMail('Este es el mensaje de prueba'));
        
        return "Correo de prueba enviado";
    }
}
