<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Notifications\SendEmail;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
class EmailController extends Controller
{
    public function index(){
        $users = User::all();
        return view('index', compact('users'));
    }

    public function sent_email(Request $request){
        $users = User::find($request->id);
        $users->notify(new SendEmail($users));
        return redirect()->back()->with('message', 'Email Send');
    }

    public function sent_customer_mail(Request $request){
    $emails = $request->input('email');
    $explod = explode(',', $emails);

        $send_mail = new Contact();
        $send_mail->email = $request->email;
        $send_mail->message = $request->message;
        $send_mail->save();

            Session::put('message', $send_mail->message);



        //$explod = $send_mail->toArray();

        Mail::send('mail-view', $explod, function ($message) use ($explod){
            $message->to($explod);
            $message->subject('Hello');
        });



        return redirect()->back()->with('Success', 'Email Send');

    }

    public function sent_student_info(Request $request){
        $student = [];
        $i = 0;
        foreach ($request->name as $info){
            $res = [
                'id' => $info,
              'name' =>   $request->name[$i],
              'roll' =>   $request->roll[$i],
            ];

            array_push($student, $res);
            $i++;

        }
        return $student;



    }
}
