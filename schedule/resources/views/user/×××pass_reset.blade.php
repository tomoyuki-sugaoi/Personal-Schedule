<!-- <!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <link rel="stylesheet" href="/css/account.css">
  <title>パスワードリセット</title>
</head>
<body>
  <section class="top_title">
    <div class="title">
      <h1><span class="left_ball">●</span>パスワードリセット<span class="right_ball">●</span></h1>
    </div>
    <div class="red"></div>
  </section>

  <section class="login_container">
    <form action="{{ route('passreset') }}" method="POST" class="login_form">
    @csrf
        @if (session('complete'))
          <span>{{ session('complete') }}</span><br>
        @endif
      <div class="form_contents">
        <label>ご登録メールアドレス<span>*</span></label><br>
        @if ($errors->has('email'))
          <span>{{ $errors->first('email') }}</span><br>
        @endif
        <input type="text" name="email" class="a_email" value="{{ old('email') }}"><br>

        <label>新しいパスワード<span>*</span></label><br>
        @if ($errors->has('new_pass'))
          <span>{{ $errors->first('new_pass') }}</span><br>
        @endif
        <input type="text" name="new_pass" class="a_pass" value="{{ old('new_pass') }}"><br>

        <label>新しいパスワード（確認用）<span>*</span></label><br>
        @if ($errors->has('pass_confirmation'))
          <span>{{ $errors->first('pass_confirmation') }}</span><br>
        @endif
        <input type="text" name="pass_confirmation" class="a_pass" value="{{ old('pass_confirmation') }}"><br>
  
        <div class="button">
          <input type="submit" name="change" class="login_btn" value="変更">
        </div>

      </div>
      <div class="login_top">
        <a href="/login">ログイン画面へ戻る</a>
      </div>
    </form>
  </section>
</body>
</html> -->