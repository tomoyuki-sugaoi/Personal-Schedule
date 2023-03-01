<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/main.css">
  <title>予定変更</title>
</head>
<body class="am">
  <section class="top_title">
    <div class="title">
      <h1><span class="left_ball">●</span><img src="/img/main_img/sun.png" width="80" height="60">予定変更<span class="right_ball">●</span></h1>
    </div>
    <div class="red"></div>
  </section>

  <section class="edit_choice_form">
    <form action="{{ route('am_edit_input') }}" method="POST" class="background_form">
    @csrf
      <div class="edit_form">
        <input type="hidden" name="am_id" value="{{ old('am_id', $edit_schedule->id) }}">
        <h1>下記の内容で登録します。</h1>
        <label>日付<span>*</span></label><br>
          @if ($errors->has('day'))
            <span>{{ $errors->first('day') }}</span><br>
          @endif
          @if (session('error'))
            <span>{{ session('error') }}</span><br>
          @endif
        <input type="date" name="day" class="pickday" value="{{ old('day', $edit_schedule->day) }}"><br>
    
        <label>時間</label><br>
          @if ($errors->has('time'))
            <span>{{ $errors->first('time') }}</span><br>
          @endif
        <input type="time" name="time" class="f_time" value="{{ old('time', $edit_schedule->time) }}"><br>
        
        <label>予定<span>*</span></label><br>
          @if ($errors->has('schedule'))
            <span>{{ $errors->first('schedule') }}</span><br>
          @endif
        <input type="text" name="schedule" class="body" value="{{ old('schedule', $edit_schedule->schedule) }}">

        <div class="edit_btns">
          <button type="submit" name="action" class="edit_btn" value="submit">登録</button>
        </div>
        <div class="edit_link">
          <a href="am_edit_choice">日付選択に戻る</P>
        </div>
      </div>
    </form>
  </section>
</body>
</html>



