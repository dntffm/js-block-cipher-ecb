<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\User; 
use Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Events\ForgotActivationEmail; 
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

   public function __construct()
    {
        $this->middleware('guest');
    }
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
 public function update(Request $request, $id)
    {
        $this->validate($request, [
        'email'=>'required|email|exists:users',
        'password' => 'required|min:5',
     ]);
        
     $user = User::whereActive_token($id)->first();   
     //dd($user);
     if($request->email !== $user->email){
        return redirect('reset')->with('error', 'email tidak valid');
             }
             else{
                $user->update([
                    'password' => bcrypt($request['password']),
                    'active_token' => null,
                    'email'=> $user->email,
                ]);
                return redirect('/login')->with('sukses','password berhasil diperbarui');
             }
        }
        public function updatepass(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5'
        ]);
        $user = User::whereActive_token($id)->first();   
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect('/login')->with('sukses','password berhasil diperbarui');
    }
}
