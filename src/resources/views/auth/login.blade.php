@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<main class="page-wrapper">

    <div class="login-form__content">
        <div class="login-form__heading">
            <h2>Login</h2>
        </div>

        <div class="form-card">
            <form class="form" action="/login" method="POST" novalidate>
                @csrf
                <!--メールアドレス-->
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                    </div>
                    @error('email')
                    <span class="form__error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- パスワード -->
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="例: coachtech1106">
                    </div>
                    @error('password')
                    <span class="form__error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- ログインボタン -->
                <div class="form__button">
                    <button class="form__button-submit" type="submit">ログイン</button>
                </div>
            </form>
        </div>
    </div>
    @endsection