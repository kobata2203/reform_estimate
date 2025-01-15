<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Login;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class LoginController extends Controller
{
    /*|--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |*/


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function validateLogin(LoginRequest $request)
    {
        $this->validate($request, [
            $this->email() => 'required|string|min:10',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(LoginRequest $request)
    {
        return $request->only($this->email(), 'password');
    }

    public function login()
    {
        session_start();
        $email = $_POST['email'];
        $sql = "SELECT * FROM users WHERE email = :mail";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':mail', $email);
        $stmt->execute();
        $member = $stmt->fetch();
        //指定したハッシュがパスワードにマッチしているかチェック
        if (password_verify($_POST['password'], $member['password'])) {
            //DBのユーザー情報をセッションに保存
            $_SESSION['id'] = $member['id'];
            $_SESSION['name'] = $member['name'];
            $msg = 'ログインしました。';

            return view('salesperson_menu.index');

        } else {
            $msg = 'メールアドレスもしくはパスワードが間違っています。';

            return view('/');
        }
    }
}

