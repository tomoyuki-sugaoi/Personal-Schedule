<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/main.css">
  <title>期限削除</title>
</head>
<body class="pm">
  <section class="top_title">
    <div class="title">
      <h1><span class="left_ball">●</span><img src="/img/main_img/moon.png" width="60" height="60">予定削除<span class="right_ball">●</span></h1>
    </div>
    <div class="red"></div>
  </section>

  <section class="register_container">
    <form action="{{ route('pm_delete_choice') }}" method="POST" class="delete_container background_form">
    @csrf
      <div class="delete_choice_day">
        <label>日付を選択<span>*</span></label><br>
        @isset($action)
          @empty($day)
          <span>日付が選択されていません。<br></span>
          @endempty
        @endisset
        <input type="date" name="pickday" class="pickday" value=""><br>
        <input type="submit" name="pickbtn" class="pickbtn" value="選択"><br><br>
      </div>

      <div class="delete_content">
        @isset($schedules)
          @foreach($schedules as $schedule)
            <div class="d_content">
              <input type="checkbox" name="delete[]" value="{{ $schedule->id }}">
              <input type="hidden" name="id" value="{{ $schedule->id }}">
              <label>日付</label>
              {{ $schedule->day }}<br>
              <label class="del_time">時間</label>
              {{ $schedule->time }}<br>
              <label class="del_body">予定</label>
              {{ $schedule->schedule }}<br>
            </div>
          @endforeach
        @endisset
      </div>

      <div class="delete_btn">
        @isset($day)
          @empty($schedule->schedule)
          <span>{{ $day }}は予定が登録されていません。<br></span>
          @endempty
        @endisset

        @if (session('error'))
          <span>{{ session('error') }}</span><br>
        @endif
        <button name="deletebtn" value="deletebtn" type="submit" class="d_btn" onclick="return confirm('本当に削除してよろしいですか？')">削除</button>
      </div>
      <div class="top pm_top">
        <a href="/calendar">カレンダーに戻る</a>
      </div>
    </form>
  </section>
</body>
</html>