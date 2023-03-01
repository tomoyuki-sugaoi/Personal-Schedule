<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deadline;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\EditRequest;

class DeadlinesController extends Controller
{
    // リダイレクト用-登録
    public function dead_regi_top()
    {
        return view('main.dead.dead_regi');
    }

    // リダイレクト用-編集
    public function dead_edit_top()
    {
        return view('main.dead.dead_edit_choice');
    }

    // リダイレクト用-削除
    public function dead_delete_top()
    {
        return view('main.dead.dead_delete_choice');
    }

    // 登録入力------------------------------------------
    public function dead_schedule(RegisterRequest $request)
    {
        if($request->has('next')) {
        // バリデーションで使うデータ
        // sessionのデータ
        $role = $request->session()->get('role');
        $account = $request->session()->get('email');
        $user_id = $request->session()->get('id');

        // 入力情報
        $day1 = $request->day1;
        $day2 = $request->day2;
        $day3 = $request->day3;
        $time1 = $request->time1;
        $time2 = $request->time2;
        $time3 = $request->time3;
        $schedule1 = $request->schedule1;
        $schedule2 = $request->schedule2;
        $schedule3 = $request->schedule3;

        // 登録件数上限のcount
        $c_day1 = Deadline::where('user_id', $user_id)->where('day', $day1)->count();
        $r_day1 = Deadline::where('user_id', $user_id)->where('day', $day1)->get();
        $c_day2 = Deadline::where('user_id', $user_id)->where('day', $day2)->count();
        $r_day2 = Deadline::where('user_id', $user_id)->where('day', $day2)->get();
        $c_day3 = Deadline::where('user_id', $user_id)->where('day', $day3)->count();
        $r_day3 = Deadline::where('user_id', $user_id)->where('day', $day3)->get();

        // カウントが3つの場合は登録不可
        if($c_day1 >= 3 && $c_day2 >= 3 && $c_day3 >= 3) {
            return redirect()->back()->with('error1', "同じ日に登録できるのは3つまでです。".$day1."は登録できません。")
            ->with('error2', "同じ日に登録できるのは3つまでです。".$day2."は登録できません。")
            ->with('error3', "同じ日に登録できるのは3つまでです。".$day3."は登録できません。")->withInput();
        }
        if($c_day1 >= 3 && $c_day2 >= 3) {
            return redirect()->back()->with('error1', "同じ日に登録できるのは3つまでです。".$day1."は登録できません。")
            ->with('error2', "同じ日に登録できるのは3つまでです。".$day2."は登録できません。")->withInput();
        }
        if($c_day1 >= 3 && $c_day3 >= 3) {
            return redirect()->back()->with('error1', "同じ日に登録できるのは3つまでです。".$day1."は登録できません。")
            ->with('error3', "同じ日に登録できるのは3つまでです。".$day3."は登録できません。")->withInput();
        }
        if($c_day2 >= 3 && $c_day3 >= 3) {
            return redirect()->back()->with('error2', "同じ日に登録できるのは3つまでです。".$day2."は登録できません。")
            ->with('error3', "同じ日に登録できるのは3つまでです。".$day3."は登録できません。")->withInput();
        }
        if($c_day1 >= 3) {
            return redirect()->back()->with('error1', "同じ日に登録できるのは3つまでです。".$day1."は登録できません。")->withInput();
        }
        if($c_day2 >= 3) {
            return redirect()->back()->with('error2', "同じ日に登録できるのは3つまでです。".$day2."は登録できません。")->withInput();
        }
        if($c_day3 >= 3) {
            return redirect()->back()->with('error3', "同じ日に登録できるのは3つまでです。".$day3."は登録できません。")->withInput();
        }

        // カウントが2つまたは1つの場合は登録制限
        foreach($r_day1 as $dead_day1) {
            if($c_day1 == 2 && $dead_day1['day'] == $day1 && $dead_day1['day'] == $day2 && $dead_day1['day'] == $day3) {
            return redirect()->back()->with('e_all', "同じ日に登録できるのは3つまでです。".$day1."は1件登録できます。")->withInput();

            } else if ($c_day1 == 2 && $dead_day1['day'] == $day1 && $dead_day1['day'] == $day2) {
            return redirect()->back()->with('error1', "同じ日に登録できるのは3つまでです。".$day1."は1件登録できます。")
            ->with('error2', "同じ日に登録できるのは3つまでです。".$day2."は1件登録できます。")->withInput();

            } else if ($c_day1 == 2 && $dead_day1['day'] == $day1 && $dead_day1['day'] == $day3) {
            return redirect()->back()->with('error1', "同じ日に登録できるのは3つまでです。".$day1."は1件登録できます。")
            ->with('error3', "同じ日に登録できるのは3つまでです。".$day3."は1件登録できます。")->withInput();

            } else if ($c_day1 == 1 && $dead_day1['day'] == $day1 && $dead_day1['day'] == $day2 && $dead_day1['day'] == $day3) {
            return redirect()->back()->with('e_all', "同じ日に登録できるのは3つまでです。".$day1."は2件登録できます。")->withInput();
            }
        }

        foreach($r_day2 as $dead_day2) {
            if ($c_day2 == 2 && $dead_day2['day'] == $day2 && $dead_day2['day'] == $day3) {
            return redirect()->back()->with('error2', "同じ日に登録できるのは3つまでです。".$day2."は1件登録できます。")
            ->with('error3', "同じ日に登録できるのは3つまでです。".$day3."は1件登録できます。")->withInput();
            }
        }

        return view('main.dead.dead_confirm', compact('day1', 'time1', 'schedule1', 'day2', 'time2', 'schedule2', 'day3', 'time3', 'schedule3'));
        }
    }

    // 登録完了
    public function dead_complete(Request $request)
    {
        $action = $request->input('action');
        $inputs = $request->except('action');

        $user_id = $request->session()->get('id');

        if($action == 'back') {
        return redirect()->route('dead_regi_top')->withInput($inputs);

        } else if($action == 'submit') {
        // create------------------------------------------
        Deadline::create([
            'user_id' => $user_id,
            'day' => $request->day1,
            'time' => $request->time1,
            'schedule' => $request->schedule1,
        ]);

        if(isset($request->day2)) {
            Deadline::create([
            'user_id' => $user_id,
            'day' => $request->day2,
            'time' => $request->time2,
            'schedule' => $request->schedule2,
            ]);
        }
        if(isset($request->day3)) {
            Deadline::create([
            'user_id' => $user_id,
            'day' => $request->day3,
            'time' => $request->time3,
            'schedule' => $request->schedule3,
            ]);
        }
        return view('main.dead.dead_complete');
        }
    }
    
    // 編集選択------------------------------------------
    public function dead_edit_choice(Request $request)
    {
        $user_id = $request->session()->get('id');
        $day = $request->pickday;
        $action = $request->pickbtn;

        $schedules = Deadline::where('user_id', $user_id)->where('day', $day)->get();

        if($request->has('pickbtn')) {
        return view('main.dead.dead_edit_choice', compact('schedules', 'day', 'action'));
        }
    }

    // 編集データ表示
    public function dead_edit_display(Request $request)
    {
        $edit_schedule = Deadline::find($request->id);
        return view('main.dead.dead_edit', compact('edit_schedule'));
    }

    // データ編集入力・完了
    public function dead_edit_input(EditRequest $request)
    {
        $user_id = $request->session()->get('id'); // user_id
        $day = $request->day; // 編集対象の日付

        $count_day = Deadline::where('user_id', $user_id)->where('day', $day)->count(); // 登録件数カウント
        $edit_schedule = Deadline::find($request->dead_id); // 編集対象のレコード

        $action = $request->input('action'); // 登録ボタン

        // 3件ある場合は他日から変更不可
        if($count_day == 3 && $edit_schedule->day !== $day) {
            return redirect()->back()->with('error', "同じ日に登録できるのは3つまでです。".$day."は登録できません。")->withInput();
        }

        if($action == 'submit') {
            $edit_schedule->update([
                'day' => $request->day,
                'time' => $request->time,
                'schedule' => $request->schedule,
            ]);
            return view('main.dead.dead_edit_complete', compact('edit_schedule'));
        }
    }

    // 削除データ表示------------------------------------------
    public function dead_delete_choice(Request $request)
    {
        // 各種
        $user_id = $request->session()->get('id');
        $day = $request->pickday;
        $action = $request->pickbtn;
        $deletebtn = $request->input('deletebtn');
        $delete_id = $request->input('delete');

        $delete_schedule = Deadline::find($request->id);
        $schedules = Deadline::where('user_id', $user_id)->where('day', $day)->get();

        // チェックボックス未チェック
        if($deletebtn == "deletebtn" && !isset($delete_id)) {
            return redirect()->back()->with('error', "削除希望の予定にチェックを入れてください。");
        }

        // 日付選択
        if($request->has('pickbtn')) {
            return view('main.dead.dead_delete_choice', compact('schedules', 'day', 'action'));
        }

        // 選択したスケジュールを削除
        $delete_schedule::destroy($delete_id);
        return view('main.dead.dead_delete_complete');
    }
}
