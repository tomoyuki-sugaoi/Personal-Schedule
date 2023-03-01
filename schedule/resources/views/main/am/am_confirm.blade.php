<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/main.css">
  <title>登録内容確認</title>
</head>
<body class="am">
  <section class="top_title">
    <div class="title">
      <h1><span class="left_ball">●</span><img src="/img/main_img/sun.png" width="80" height="60">登録内容確認<span class="right_ball">●</span></h1>
    </div>
    <div class="red"></div>
  </section>

  <section class="register_container">
    <form action="{{ route('am_complete') }}" method="POST">
    @csrf
    <div class="background_form">
      <h2>下記の内容で登録してよろしいですか？</h2>
      <div class="default_form">
        <h1>1</h1>
        <div class="confirm_contents">
          <div class="content">
            <label>日付</label><br>
            <p>{{ $day1 }}</p><br>
            <input name="day1" value="{{ $day1 }}" type="hidden">
          </div>
          
          <div class="content">
            <label>時間</label><br>
            <p>{{ $time1 }}</p><br>
            <input name="time1" value="{{ $time1 }}" type="hidden">
          </div>
          
          <div class="content">
            <label>予定</label><br>
            <p class="confirm">{{ $schedule1 }}</p><br>
            <input name="schedule1" value="{{ $schedule1 }}" type="hidden">
          </div>          
        </div>
      </div>
      
      <div class="default_form">
        <h1>2</h1>
        <div class="confirm_contents">
          <div class="content">
            <label>日付</label><br>
            @if($day2) 
              <p>{{ $day2 }}</p><br>
            @else
              <p></p><br>
            @endif
            <input name="day2" value="{{ $day2 }}" type="hidden">
          </div>
          <div class="content">
            <label>時間</label><br>
            @if($time2) 
              <p>{{ $time2 }}</p><br>
            @else
              <p></p><br>
            @endif
            <input name="time2" value="{{ $time2 }}" type="hidden">
          </div>
          <div class="content">
            <label>予定</label><br>
            @if($schedule2) 
              <p>{{ $schedule2 }}</p><br>
            @else
              <p></p><br>
            @endif
            <input name="schedule2" value="{{ $schedule2 }}" type="hidden">
          </div>
        </div>
      </div>
      
      <div class="default_form">
        <h1>3</h1>
          <div class="confirm_contents">
            <div class="content">
              <label>日付</label><br>
              @if($day3) 
                <p>{{ $day3 }}</p><br>
              @else
                <p></p><br>
              @endif
              <input name="day3" value="{{ $day3 }}" type="hidden">
            </div>
            <div class="content">
              <label>時間</label><br>
              @if($time3) 
                <p>{{ $time3 }}</p><br>
              @else
                <p></p><br>
              @endif
              <input name="time3" value="{{ $time3 }}" type="hidden">
            </div>
            <div class="content">
              <label>予定</label><br>
              @if($schedule3) 
                <p>{{ $schedule3 }}</p><br>
              @else
                <p></p><br>
              @endif
              <input name="schedule3" value="{{ $schedule3 }}" type="hidden">
            </div>
          </div>
        </div>
      
        <div class="buttons">
          <button type="submit" name="action" class="btn next" value="submit">登録</button>
          <button type="submit" name="action" class="btn back" value="back">戻る</button>
        </div>
      </form>
    </div>
  </section>

</body>
</html>