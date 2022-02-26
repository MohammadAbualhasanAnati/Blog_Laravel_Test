<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
      
    public function postLogin(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ],['login.required'=>'The username or email is required!']);
   
        $credentials = array('email'=>$request->login,'password'=>$request->password);
        if (Auth::attempt($credentials)) {
                return redirect()->intended('admin')
                            ->withSuccess('Signed in successfully!');
        }else{
            $credentials = array('username'=>$request->login,'password'=>$request->password);
            if (Auth::attempt($credentials)) {
                return redirect()->intended('admin')
                            ->withSuccess('Signed in successfully!');
            }else{
                return redirect("/auth/login")->withErrors(['loginFail'=>'The login credintals is not valid!']);
            }
        }

        return redirect("/auth/login")->withMessages($validated);
    }
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("/auth/login")->withErrors('You are not allowed to access');
    }
    
    public function postLogout() {
        if(!Auth::check()){
            return redirect("/auth/login")->withErrors('You already logged out!');
        }
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }
}