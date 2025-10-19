@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-container">
    <h1 class="confirm-title">Confirm</h1>

    <form action="{{ route('contact.confirm') }}" method="POST">
        @csrf

        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>{{ $inputs['last_name'] }}　{{ $inputs['first_name'] }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @if($inputs['gender'] == 1)
                        男性
                    @elseif($inputs['gender'] == 2)
                        女性
                    @else
                        その他
                    @endif
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $inputs['email'] }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $inputs['tel'] }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $inputs['address'] }}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>{{ $inputs['building'] ?? '' }}</td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>
                    @php
                        $category = \App\Models\Category::find($inputs['category_id']);
                    @endphp
                    {{ $category ? $category->content : '不明' }}
                </td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>{{ $inputs['detail'] }}</td>
            </tr>
        </table>

        {{-- 隠しフィールドで値を引き継ぐ --}}
        @foreach ($inputs as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <div class="button-area">
            <button class="submit-btn" type="submit" name="action" value="submit" formaction="{{ route('contact.thanks') }}">送信</button>
            <button class="back-btn" type="submit" name="action" value="back">修正</button>
        </div>
    </form>
</div>
@endsection
