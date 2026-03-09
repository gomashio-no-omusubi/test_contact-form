@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-form__content">
    <div class="confirm-form__heading">
        <h2>Confirm</h2>
    </div>

    <form class="form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <!--名前-->
            <div class="form-group">
                <div class="label">お名前</div>
                <div class="content">
                    <span>{{ $contact['last_name'] }}&emsp;{{ $contact['first_name'] }}</span>
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" />
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" />

                </div>
            </div>
            <!--性別-->
            <div class=" form-group">
                <div class="label">性別</div>
                <div class="content">
                    <span>{{ $gender_text }}</span>
                    <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                </div>
            </div>
            <!--メールアドレス-->
            <div class="form-group">
                <div class="label">メールアドレス</div>
                <div class="content">
                    <span>{{ $contact['email'] }}</span>
                    <input type="hidden" name="email" value="{{ $contact['email'] }}" />
                </div>
            </div>
            <!--電話番号-->
            <div class="form-group">
                <div class="label">電話番号</div>
                <div class="content">
                    <span>{{ $contact['tel'] }}</span>
                    <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}" />
                    <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                    <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                </div>
            </div>
            <!--住所-->
            <div class="form-group">
                <div class="label">住所</div>
                <div class="content">
                    <span>{{ $contact['address'] }}</span>
                    <input type="hidden" name="address" value="{{ $contact['address'] }}" />
                </div>
            </div>
            <!--建物名-->
            <div class="form-group">
                <div class="label">建物名</div>
                <div class="content">
                    <span>{{ $contact['building'] }}</span>
                    <input type="hidden" name="building" value="{{ $contact['building'] }}" />
                </div>
            </div>
            <!--お問い合わせの種類-->
            <div class="form-group">
                <div class="label">お問い合わせの種類</div>
                <div class="content">
                    <span>{{ $category_name }}</span>
                    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" />
                </div>
            </div>
            <!--お問い合わせ内容-->
            <div class="form-group">
                <div class="label">お問い合わせ内容</div>
                <div class="content">
                    <span>{{ $contact['detail'] }}</span>
                    <input type="hidden" name="detail" value="{{ $contact['detail'] }}" />
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">送信</button>
            <button class="btn-edit" type="submit" name="action" value="back">修正</button>
        </div>
    </form>
</div>
@endsection