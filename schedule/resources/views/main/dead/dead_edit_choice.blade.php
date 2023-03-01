<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/main.css">
  <title>予定変更</title>
</head>
<body class="eve">
  <section class="top_title">
    <div class="title">
      <h1><span class="left_ball">●</span><img src="/img/main_img/check.png" width="60" height="60">予定変更<span class="right_ball">●</span></h1>
    </div>
    <div class="red"></div>
  </section>

  <section class="edit_choice_form">
    <form action="{{ route('dead_edit_choice') }}" method="POST" class="edit_container background_form">
    @csrf
      <label>日付を選択<span>*</span></label><br>
      @isset($action)
        @empty($day)
        <span>日付が選択されていません。<br></span>
        @endempty
      @endisset
      <input type="date" name="pickday" class="pickday"><br>
      <input type="submit" name="pickbtn" class="pickbtn" value="選択"><br><br>

      @isset($schedules)
        @foreach($schedules as $schedule)
          <div class="edit_content">
            <input type="hidden" name="id" value="{{ $schedule->id }}">
            <label>日付</label>
            {{ $schedule->day }}<br>
            <label>時間</label>
            {{ $schedule->time }}<br>
            <label>予定</label>
            {{ $schedule->schedule }}<br>
          </div>
          <div class="edit_button">
            <a href="dead_edit?id={{ $schedule->id }}">編集</a><br>
          </div>
        @endforeach
      @endisset

      @isset($day)
        @empty($schedule->schedule)
        <span>{{ $day }}は予定が登録されていません。</span>
        @endempty
      @endisset

      <div class="top">
        <a href="calendar">カレンダーに戻る</a>
      </div>
    </form>
  </section>
</body>
</html>