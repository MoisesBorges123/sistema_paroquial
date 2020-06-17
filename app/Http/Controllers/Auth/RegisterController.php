<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Painel\Pessoa\Pessoa;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|string|max:255|unique:usuarios',
            'password' => 'required|string|max:255',
            'pessoa' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function store(array $data)
    {
        return User::create([
            'pessoa' => $data['pessoa'],
            'login' => $data['login'],
            'password' => bcrypt($data['password']),
            /*
            *$hash1 = bcrypt('secret')
            $hash2 = bcrypt('secret')
            Hash::check('secret', $hash1)
            Hash::check('secret', $hash2)
            Você deve obter true nos dois casos de Hash::check.
            */
        ]);
    }
    public function create(){
        return view('register');
    }
    public function register(Request $request){     
        $fn_pessoa = new Pessoa;   
        $pessoa = $fn_pessoa->salvar_pessoa($request);        
        
        $data = array(
            'login'=>$request->input('login'),
            'password'=>$request->input('password'),
            'pessoa'=>$pessoa['insert_pessoa']->id_pessoa,
            
        );
        $validator = $this->validator($data);
        if($validator->fails()){
            dd($validator);exit();
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }else{
            $cadastro=$this->store($data);
            return redirect()
            ->back();
        }
    }
}
