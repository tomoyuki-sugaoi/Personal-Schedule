<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AmSchedule;
use App\Models\PmSchedule;
use App\Models\Deadline;
use App\Models\User;

class CalendarsController extends Controller
{
    // カレンダー日付を表示--------------------------------------------
    public function schedule(Request $request)
    {
        // 選択した日付とメールアドレスを取得
        $today = $request->day;
        $tomonth = $request->month;
        $toyear = $request->year;
        $account = $request->session()->get('email');
        $role = $request->session()->get('role');
        $id =$request->session()->get('id');

        // データベースから情報を引っ張るためのデータ
        // 日付
        $day = $toyear."-".$tomonth."-".$today;

        // ユーザID
        if ($account == 'no_user@no.user') {
            $id = User::select('id')->where('email', $account)->get();
        } else {
            $id = Auth::id();
        }

        // 日付とユーザIDが一致したスケジュールを取得
        $am_schedules = AmSchedule::orderByRaw('time is null asc')->orderBy('time', 'asc')->where('day', $day)->where('user_id', $id)->get();
        $pm_schedules = PmSchedule::orderByRaw('time is null asc')->orderBy('time', 'asc')->where('day', $day)->where('user_id', $id)->get();
        $deadlines = Deadline::orderByRaw('time is null asc')->orderBy('time', 'asc')->where('day', $day)->where('user_id', $id)->get();

        // テストに表示
        return view('calendar.calendar', compact('am_schedules', 'pm_schedules', 'deadlines')); 
    }

    // 登録リンク--------------------------------------------
    public function am_register(Request $request)
    {
        $role = $request->session()->get('role');

        if ($role == '1') {
            return view('main.am.am_sche_regi');
        } else if ($role == '0') {
            return redirect('calendar')->with('nouser', 'nouser');
        }
    }

    public function pm_register(Request $request)
    {
        $role = $request->session()->get('role');

        if ($role == '1') {
            return view('main.pm.pm_sche_regi');
        } else if ($role == '0') {
            return redirect('calendar')->with('nouser', 'nouser');
        }
    }

    public function dead_register(Request $request)
    {
        $role = $request->session()->get('role');

        if ($role == '1') {
            return view('main.dead.dead_regi');
        } else if ($role == '0') {
            return redirect('calendar')->with('nouser', 'nouser');
        }
    }

    // 編集リンク--------------------------------------------
    public function am_edit(Request $request)
    {
        $role = $request->session()->get('role');

        if ($role == '1') {
            return view('main.am.am_edit_choice');
        } else if ($role == '0') {
            return redirect('calendar')->with('nouser', 'nouser');
        }
    }

    public function pm_edit(Request $request)
    {
        $role = $request->session()->get('role');

        if ($role == '1') {
            return view('main.pm.pm_edit_choice');
        } else if ($role == '0') {
            return redirect('calendar')->with('nouser', 'nouser');
        }
    }

    public function dead_edit(Request $request)
    {
        $role = $request->session()->get('role');

        if ($role == '1') {
            return view('main.dead.dead_edit_choice');
        } else if ($role == '0') {
            return redirect('calendar')->with('nouser', 'nouser');
        }
    }

    // 削除リンク--------------------------------------------
    public function am_delete(Request $request)
    {
        $role = $request->session()->get('role');

        if ($role == '1') {
            return view('main.am.am_delete_choice');
        } else if ($role == '0') {
            return redirect('calendar')->with('nouser', 'nouser');
        }
    }

    public function pm_delete(Request $request)
    {
        $role = $request->session()->get('role');

        if ($role == '1') {
            return view('main.pm.pm_delete_choice');
        } else if ($role == '0') {
            return redirect('calendar')->with('nouser', 'nouser');
        }
    }

    public function dead_delete(Request $request)
    {
        $role = $request->session()->get('role');

        if ($role == '1') {
            return view('main.dead.dead_delete_choice');
        } else if ($role == '0') {
            return redirect('calendar')->with('nouser', 'nouser');
        }
    }

}
