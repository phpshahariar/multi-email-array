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

        $i = 0;
        foreach ($request->name as $key => $info){
            $student = new Student();
            $student->name = $request->name[$key];
            $student->roll = $request->roll[$key];
            $student->save();
        }
//
//        for ($i; $i < count($request->name); $i++){
//            $student = new Student();
//            $student->name = $request->name[$i];
//            $student->roll = $request->roll[$i];
//            $student->save();
//        }
        return redirect()->back();



    }

    public function one_click_mail(Request $request){
        $users = User::all();
        $all_mail =  $users->pluck('email')->toArray();


            Mail::send('mail-view', $all_mail, function ($message) use ($all_mail){
                $message->to($all_mail);
                $message->subject('Hello');

            });

        return redirect()->back();

    }


    public function one_click_sms(Request $request){


        $url = 'http://powersms.banglaphone.net.bd/httpapi/sendsms';
        $fields = array(
            'userId' => urlencode('banglakings'),
            'password' => urlencode('bksoft2018'),
            'smsText' => urlencode('This is a sample sms text.'),
            'commaSeperatedReceiverNumbers' => $request->input('email'),
        );
        $fields_string = '';
        foreach($fields as $key=>$value){
            $fields_string .= $key.'='.$value.'&';
            return $fields_string;
        }



        rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);

// If you have proxy
// $proxy = '<proxy-ip>:<proxy-port>';
// curl_setopt($ch, CURLOPT_PROXY, $proxy);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);

        if($result === false)
        {
            echo sprintf('<span>%s</span>CURL error:', curl_error($ch));
            return;
        }

        $json_result = json_decode($result);
        var_dump($json_result);

        if($json_result->isError){
            echo sprintf("<p style='color:red'>ERROR: <span style='font-weight:bold;'>%s</span></p>", $json_result->message);
        }
        else{
            echo sprintf("<p style='color:green;'>SUCCESS!</p>");
        }

        curl_close($ch);
    }
}
