@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection

@section('content')
<div class="dashboard-form__content">
    <div class="dashboard-form__heading">
        <h2>Admin</h2>
    </div>

    <form class="form" action="/admin/search" method="get">
        <div class="search-form__content">
            <!--名前・メールアドレス-->
            <div class="search-form__item">
                <input class="name-email-box" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
                <input type="hidden" name="mode" value="partial">
            </div>
            <!--性別-->
            <div class="search-form__item">
                <select name="gender" class="select-box">
                    <option value="" selected disabled>性別</option>
                    <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            <!--お問い合わせの種類-->
            <div class="search-form__item">
                <select name="category_id" class="select-box">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}" {{ request('category_id') == $category['id'] ? 'selected' : '' }}>
                        {{ $category['content'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <!--日付-->
            <div class="search-form__item">
                <input class="calendar-box" type="date" name="date" value="{{ request('date') }}">
            </div>

            <button class="btn-search" type="submit">検索</button>
            <a href="/admin/reset" class="btn-reset">リセット</a>
        </div>
    </form>

    <div class="table-control">
        <a href="{{ url('/admin/export?' . http_build_query(request()->query())) }}" class="btn-export">エクスポート</a>
        <div class="pagination-wrapper">
            {{ $contacts->links('vendor.pagination.tailwind2') }}
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact['last_name'] }}&emsp;{{ $contact['first_name'] }}</td>
                <td>{{ $contact['gender_text'] }}</td>
                <td>{{ $contact['email'] }}</td>
                <td>{{ $contact['category']['content'] ?? '' }}</td>
                <td>
                    <a href="/admin/search?{{ http_build_query(array_merge(request()->query(), ['modal' => 'show', 'id' => $contact->id])) }}" class="btn-detail">
                        詳細
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!--モーダルウィンドウ-->
    @if(request('modal') === 'show' && $detail)
    <div class="modal-overlay">
        <div class="modal-content">
            <div class="modal-close-wrapper">
                <a href="{{ request()->fullUrlWithQuery(['modal' => null, 'id' => null]) }}" class="close-icon">×</a>
            </div>
            <div class="modal-detail-list">
                <div class="modal-detail-row">
                    <div class="modal-detail-label">お名前</div>
                    <div class="modal-detail-value">{{ $detail['last_name'] }}&emsp;{{ $detail['first_name'] }}</div>
                </div>
                <div class="modal-detail-row">
                    <div class="modal-detail-label">性別</div>
                    <div class="modal-detail-value">{{ $detail['gender_text'] }}</div>
                </div>
                <div class="modal-detail-row">
                    <div class="modal-detail-label">メールアドレス</div>
                    <div class="modal-detail-value">{{ $detail['email'] }}</div>
                </div>
                <div class="modal-detail-row">
                    <div class="modal-detail-label">電話番号</div>
                    <div class="modal-detail-value">{{ $detail['tel'] }}</div>
                </div>
                <div class="modal-detail-row">
                    <div class="modal-detail-label">住所</div>
                    <div class="modal-detail-value">{{ $detail['address'] }}</div>
                </div>
                <div class="modal-detail-row">
                    <div class="modal-detail-label">建物名</div>
                    <div class="modal-detail-value">{{ $detail['building'] }}</div>
                </div>
                <div class="modal-detail-row">
                    <div class="modal-detail-label">お問い合わせの種類</div>
                    <div class="modal-detail-value">{{ $detail['category']['content'] ?? '' }}</div>
                </div>
                <div class="modal-detail-row">
                    <div class="modal-detail-label">お問い合わせ内容</div>
                    <div class="modal-detail-value">{{ $detail['detail'] }}</div>
                </div>
            </div>


            <div class="modal-actions">
                <form action="/admin/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $detail['id'] }}">
                    <button type="submit" class="btn-delete">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endif
</div>
@endsection