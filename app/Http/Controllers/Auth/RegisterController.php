<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

use Xzxzyzyz\Laravel\JapaneseValidation\Rules\Katakana;

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
    protected $redirectTo = '/login';

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
    public function validator(array $data){
        $messages = [
            'required' => ':attribute フィールドは必須です。',
            'email' => '有効なメールアドレスである必要があります。',
            'unique' => 'メールアドレスは既に使用されています。',
            'min' => ':attribute は最低 :min 文字以上である必要があります。',
            'password' => 'パスワード と一致させる必要があります',
            'name_kana' => 'カタカナで入力してください。'
        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255',],
            'name_kana' => ['required', 'string', 'max:255', new Katakana],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request){
        $data = $request->all();

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }
        $user = new User;
        $user->name = $data['name'];
        $user->name_kana = $data['name_kana'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        $user->save();

        return redirect('login');
    }


}
