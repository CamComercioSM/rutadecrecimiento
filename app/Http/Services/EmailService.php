<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public static function send($to, $subject, $template, $data) {
        //try 
        //{
            //Mail::send($template, ['data' => $data], function ($m) use ($to, $subject) {
                //$m->from(env('MAIL_FROM_ADDRESS'), 'Ruta de crecimiento');
              //  $m->to($to)->subject($subject);
              //  $m->to('test-rutac@yopmail.com')->subject($subject);
                //$m->to('rutac@ccsm.org.co')->subject($subject);
           // });
       // } 
        //catch (\Exception $e) {
           
          //  dd($e);
    //    }
    }
}