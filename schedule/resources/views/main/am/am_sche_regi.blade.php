<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/main.css">
  <title>予定登録</title>
</head>
</head>
<body class="am">
  <section class="top_title">
    <div class="title">
      <h1><span class="left_ball">●</span><img src="/img/main_img/sun.png" width="80" height="60">予定登録<span class="right_ball">●</span></h1>
    </div>
    <div class="red"></div>
  </section>
  <section class="am_schedule">
    <form action="{{ route('am_schedule') }}" method="POST" class="background_form">
    @csrf
      <div class="default_form">
        <h1>1</h1>
        <div class="form_contents">
          <div class="content">
            <label>日付<span>*</span></label><br>
            @if ($errors->has('day1'))
              <span>{{ $errors->first('day1') }}</span><br>
            @endif
            @if (session('error1'))
              <span>{{ session('error1') }}</span><br>
            @endif
            @if (session('e_all'))
              <span>{{ session('e_all') }}</span><br>
            @endif
            @if (session('e_two'))
              <span>{{ session('e_two') }}</span><br>
            @endif
            <input type="date" name="day1" class="day" value="{{ old('day1') }}"><br>
          </div>
          <div class="content">
            <label>時間</label><br>
              <input type="time" name="time1" class="f_time" value="{{ old('time1') }}"><br>
          </div>
          <div class="content">
            <label>予定<span>*</span></label><br>
            @if ($errors->has('schedule1'))
              <span>{{ $errors->first('schedule1') }}</span><br>
            @endif
            <input type="text" name="schedule1" class="body" value="{{ old('schedule1') }}"><br>
          </div>          
        </div>
      </div>
      
      <div class="default_form">
        <h1>2</h1>
        <div class="form_contents">
          <div class="content">
            <label>日付<span>*</span></label><br>
            @if ($errors->has('day2'))
              <span>{{ $errors->first('day2') }}</span><br>
            @endif
            @if (session('error2'))
              <span>{{ session('error2') }}</span><br>
            @endif
            @if (session('e_all'))
              <span>{{ session('e_all') }}</span><br>
            @endif
            @if (session('e_two'))
              <span>{{ session('e_two') }}</span><br>
            @endif
            <input type="date" name="day2" class="day" value="{{ old('day2') }}"><br>
          </div>
          <div class="content">
            <label>時間</label><br>
              <input type="time" name="time2" class="f_time" value="{{ old('time2') }}"><br>
          </div>
          <div class="content">
            <label>予定<span>*</span></label><br>
            @if ($errors->has('schedule2'))
              <span>{{ $errors->first('schedule2') }}</span><br>
            @endif
            <input type="text" name="schedule2" class="body" value="{{ old('schedule2') }}"><br>
          </div>
        </div>
      </div>

      <div class="default_form">
        <h1>3</h1>
        <div class="form_contents">
          <div class="content">
            <label>日付<span>*</span></label><br>
            @if ($errors->has('day3'))
              <span>{{ $errors->first('day3') }}</span><br>
            @endif
            @if (session('error3'))
              <span>{{ session('error3') }}</span><br>
            @endif
            @if (session('e_all'))
              <span>{{ session('e_all') }}</span><br>
            @endif
            @if (session('e_two'))
              <span>{{ session('e_two') }}</span><br>
            @endif
            <input type="date" name="day3" class="day" value="{{ old('day3') }}"><br>
          </div>
          <div class="content">
            <label>時間</label><br>
              <input type="time" name="time3" class="f_time" value="{{ old('time3') }}"><br>
          </div>
          <div class="content">
            <label>予定<span>*</span></label><br>
            @if ($errors->has('schedule3'))
              <span>{{ $errors->first('schedule3') }}</span><br>
            @endif
            <input type="text" name="schedule3" class="body" value="{{ old('schedule3') }}"><br>
          </div>
        </div>
      </div>
      <div class="buttons">
        <input type="submit" name="next" class="btn next" value="確認">
      </div>
    </form>
    <div class="top">
      <a href="calendar">カレンダーに戻る</P>
    </div>
  </section>

</body>
</html>