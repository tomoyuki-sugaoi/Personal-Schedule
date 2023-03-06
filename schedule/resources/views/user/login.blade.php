<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/account.css">
  <title>ログイン</title>
</head>
<body>
  <section class="top_title">
    <div class="title">
      <h1><span class="left_ball">●</span>パーソナル　スケジュール<span class="right_ball">●</span></h1>
    </div>
    <div class="red"></div>
  </section>

  <form action="{{ route('login') }}" method="POST" class="login_form">
    @csrf
    <section class="login_container">
      <div class="form_contents">
        <!-- メールアドレス相違 -->
        <span><?php if (isset($error_log['mailpass'])) { echo $error_log['mailpass']; }?></span>
        <!-- メールアドレス -->
        @if ($errors->has('email'))
          <span>{{ $errors->first('email') }}</span><br>
        @endif
        @if (session('error'))
          <span>{{ session('error') }}</span><br>
        @endif
        <input type="text" name="email" class="a_email" placeholder="メールアドレス" value="{{ old('email') }}"><br>
        <!-- パスワード -->
        @if ($errors->has('password'))
          <span>{{ $errors->first('password') }}</span><br>
        @endif
        <input type="text" name="password" class="a_pass" placeholder="パスワード" value="{{ old('password') }}"><br>
        <!-- ログインボタン -->
        <input type="submit" name="login" class="login_btn" value="ログイン"><br>
      </div>
    </section>

    <section class="links">
      <p>パスワードをお忘れの方は<a href="{{ route('password.request') }}">こちら</a></p>
      <p>会員登録がまだの方は<a href="user_regi">こちら</a>からご登録ください</p>
      <input type="submit" name="nouser" class="nouser" value="ログインせずに利用する">
    </section>
  </form>

  <footer>@Personal Schedule</footer>
</body>
</html>
