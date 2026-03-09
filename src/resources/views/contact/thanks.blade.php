@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/thanks.css') }}">
@endsection

@section('content')
<div class="thanks_content">
    <div class="thanks_background">
        <span>Thank you</span>
    </div>

    <div class="thanks_heading">
        <h2>お問い合わせありがとうございました</h2>
    </div>
    <div class="form__button">
        <a href="/" class="form__button-submit">HOME</a>
    </div>
</div>
@endsection