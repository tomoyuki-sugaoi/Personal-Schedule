<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegiRequest;
use App\Http\Requests\PassRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AmSchedule;
use App\Models\PmSchedule;
use App\Models\Deadline;

class UsersController extends Controller
{
    // ログイン--------------------------------------------
    public function login(Request $request)
    {
        // ログインボタンを押したら
        if ($request->has('login')) 
        {
            // バリデーション
            $user_info = $request->validate([
                'email' => 'required | email',
                'password' => 'required',
            ],
            [
                'email.required' => 'メールアドレスは入力必須です。',
                'email.email' => 'メールアドレスは正しくご入力ください。',
                'password.required' => 'パスワードは入力必須です。',
            ]
        );

            // ログイン成功
            if (Auth::attempt($user_info)) {
                $request->session()->regenerate();

                // ログインしたらログイン時のアドレスをセッションに入れて$accountに保存
                session()->put('email', $request->email);
                $account = $request->session()->get('email');
                
                // 日付を各変数に保存
                $today = $request->day ?? date('j');
                $tomonth = $request->month ?? date('n');
                $toyear = $request->year ?? date('Y');

                // データベースから情報を引っ張るためのデータ----------------------
                $day = $toyear."-".$tomonth."-".$today; // 日付

                // ユーザIDをsessionに入れる
                $user_id = auth()->user()->id;
                session()->put('id', $user_id);
                $id =$request->session()->get('id');

                // roleをsessionに入れる
                $user_role = auth()->user()->role;
                session()->put('role', $user_role);
                $role = $request->session()->get('role');

                // モデルから全データを抽出----------------------
                $am_schedules = AmSchedule::select('time', 'schedule')->where('day', $day)->where('user_id', $id)->get();
                $pm_schedules = PmSchedule::select('time', 'schedule')->where('day', $day)->where('user_id', $id)->get();
                $deadlines = Deadline::select('time', 'schedule')->where('day', $day)->where('user_id', $id)->get();

                // カレンダーに表示----------------------
                return view('calendar.calendar', compact('am_schedules', 'pm_schedules', 'deadlines', 'account', 'id', 'day', 'role'));
            }
    
            // ログイン失敗
            return redirect()->back()->with('error', 'メールアドレスまたはパスワードに誤りがあります。')->withInput();
        }   
        
        // ログインなしで利用を押したら
        if ($request->has('nouser')) 
        {
            $email = "no_user@no.user";
            $password = "testpassword";

            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $request->session()->regenerate();
            }

            // sessionにゲスト用アカウントを入れる
            session()->put('email', $email);
            $account = $request->session()->get('email');

            // 日付を各変数に保存
            $today = $request->day ?? date('j');
            $tomonth = $request->month ?? date('n');
            $toyear = $request->year ?? date('Y');

            // データベースから情報を引っ張るためのデータ----------------------
            $day = $toyear."-".$tomonth."-".$today; // 日付

            // ユーザIDをsessionに入れる
            $user_id = auth()->user()->id;
            session()->put('id', $user_id);
            $id =$request->session()->get('id');

            // roleをsessionに入れる
            $guest_role = auth()->user()->role;
            session()->put('role', $guest_role);
            $role = $request->session()->get('role');
            
            // 日付とユーザIDが一致したスケジュールを取得----------------------
            $am_schedules = AmSchedule::select('time', 'schedule')->where('day', $day)->where('user_id', $id)->get();
            $pm_schedules = PmSchedule::select('time', 'schedule')->where('day', $day)->where('user_id', $id)->get();
            $deadlines = Deadline::select('time', 'schedule')->where('day', $day)->where('user_id', $id)->get();

            // カレンダーに表示----------------------
            return view('calendar.calendar', compact('am_schedules', 'pm_schedules', 'deadlines', 'id', 'day', 'role', 'account'));
        }
    }

    // 会員登録--------------------------------------------
    public function register(UserRegiRequest $request)
    {
        // ユーザーモデルの呼び出し
        $user = new User();

        // UserRegiRequestでバリデーションした後の値をcreate
        $user->create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 完了画面に遷移
        return view('user.user_regi_comp');
    }

    // ログアウト
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/');
    }

    // パスワードリセット
    // public function passreset(Request $request)
    // {
    //     // $action = $request->input('action'); // 登録ボタン

    //     $user = new User();

    //     if($request->has('change')) {
    //         $email = $request->email;
    //         $change = $user->find($email);
    //         $change->update([
    //           'email' => $request->email,
    //           'password' => Hash::make($request->new_pass),
    //         ]);
    //         return redirect()->route('pass_reset_top')->with('complete', 'パスワード変更が完了しました。');
    //         // return view('user.pass_reset', compact('email', 'change'));
    //       }
    // }
}
