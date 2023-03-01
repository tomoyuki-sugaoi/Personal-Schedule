<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/account.css">
    <title>パスワードリセット</title>
</head>
<body>

    <x-guest-layout>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
    
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
    
            <!-- Email Address -->
            <div>
                <x-input-label class="font-bold" for="email" :value="__('メールアドレス')" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label class="font-bold" for="password" :value="__('新しいパスワード')" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label class="font-bold" for="password_confirmation" :value="__('確認用パスワード')" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
    

            </div>
    
            <div class="flex items-center justify-end mt-4 mb-8">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
        <a href="/login">ログイン画面に戻る</P>
    </x-guest-layout>
    
</body>
</html>

