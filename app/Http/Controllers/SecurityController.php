<?php

namespace App\Http\Controllers;
use App\Mail\forgotemail; 
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Events\ForgotActivationEmail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Sentinel;
use Reminder;
use App\User; 
use Mail;
use auth;
class SecurityController extends Controller
{
  //kirim email aktif
  // use SendsPasswordResetEmails;
   public function forgot()
   {
   return view('auth.forgetpassword');
   }

   public function forgotpw(Request $request){
    $this->validate($request,[
      'email'=>'required|email|exists:users'
    ]);
    $user = User::whereEmail($request->email)->first();
    //dd($request->all());
    if($user == null){
      return redirect()->back()->with('error', 'email belum didaftarkan');
    }else{
      $user->update([
        'active_token'=>rand(100000,999999),
      ]); 
       try {
      event(new ForgotActivationEmail($user));}
      catch(\Exception $e) {
            return view('auth.v_pesanerror');
        }
    }
      return redirect('/forgot_password/reset')->with('success','reset kode password telah dikirim ke email mu');
}

//kirim token   
	public function verifytoken()
	{
		return view('auth.verifytoken');
	}

public function ubah()
  {
    return view('emails.changepassword');
  }

	public function postverifytoken(Request $request)
	{
		$user=User::whereActive_token($request->active_token)->first();
   
		//dd($user);
		if($user == null){
    	return redirect()->back()->with('error', 'token tidak valid');
   	  	}
        else{

            //dd($user);}
       //return redirect('/resetpassword/')->with('success','silahkan masukkan password baru' );}
    	 // return view('/resetpassword/'.['$user->id'])->with('success','silahkan masukkan password baru' );}
     return redirect('/resetpassword/'.$user->id)->with('success','silahkan masukkan password baru' );}
       
       
	}

  

   public function reset($id)
   {
     // $user=User::whereActive_token($request->active_token)->first();
    $user = \App\User::find($id);
   return view('auth.reset', ['user'=>$user]);
   }

   
    // $user = Sentinel::findById($user->id);
    // $reminder = Reminder::exists($user) ? : Reminder::create($user);
    // $this->sendEmail($user, $reminder->code);


   public function sendEmail($user, $code){
   	mail::send(
   		'email.forgot',
   		[ 'user' => $user, 'code'=>$code
   		],
   		function($message) use ($user){
   			$message->to($user->email);
   			$message->subject("user->username, reset your password");
   		}
   	);
   }
         public function updatepass(Request $request,$id)
    {
        $request->validate([
            'password' => 'required|min:5'
        ]);
        $user = \App\User::find($id); 
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect('/login')->with('sukses','password berhasil diperbarui');
    }
}
