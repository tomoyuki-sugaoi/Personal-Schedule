<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/account.css">
  <title>新規アカウント登録</title>
</head>
<body>
  <section class="top_title">
    <div class="title">
      <h1><span class="left_ball">●</span>新規アカウント登録<span class="right_ball">●</span></h1>
    </div>
    <div class="red"></div>
  </section>

  <section class="login_container">
    <form action="{{ route('regi') }}" method="POST" class="login_form">
    @csrf
      <div class="form_contents">
        <label>メールアドレス<span>*</span></label><br>
        @if ($errors->has('email'))
          <span>{{ $errors->first('email') }}</span><br>
        @endif
        <input type="text" name="email" class="a_email" value="{{ old('email') }}"><br>
  
        <label>パスワード<span>*</span></label><br>
        @if ($errors->has('password'))
          <span>{{ $errors->first('password') }}</span><br>
        @endif
        <input type="text" name="password" class="a_pass" value="{{ old('password') }}"><br>
  
        <div class="button">
          <input type="submit" name="regi" class="login_btn" value="登録">
        </div>
        <div class="login_top">
          <a href="/login">ログイン画面に戻る</a>
        </div>
      </div>
    </form>
  </section>

  <footer>@Personal Schedule</footer>
</body>
</html>
