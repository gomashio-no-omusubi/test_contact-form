@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<main class="page-wrapper">

    <div class="register-form__content">
        <div class="register-form__heading">
            <h2>Register</h2>
        </div>

        <div class="form-card">
            <form class="form" action="/register" method="POST" novalidate>
                @csrf
                <!-- お名前 -->
                <div class="form-group">
                    <label for="name">お名前</label>
                    <div class="input-wrapper">
                        <input type="text" id="name" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}">
                    </div>
                    @error('name')
                    <span class="form__error">{{ $message }}</span>
                    @enderror
                </div>
                <!--メールアドレス -->
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
                <!-- 登録ボタン -->
                <div class="form__button">
                    <button class="form__button-submit" type="submit">登録</button>
                </div>
            </form>
        </div>
    </div>
    @endsection