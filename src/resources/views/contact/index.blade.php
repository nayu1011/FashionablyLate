@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
    <div class="contact-container">
        <h1 class="contact-title">Contact</h1>
        <form class="contact-form" action="{{ route('contact.confirm') }}" method="POST" novalidate>
            @csrf
            <div class="form-row">
                <label class="form-label required" for="last_name">お名前</label>
                <div class="form-field name-field">
                    <div>
                        <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}">
                        @error('last_name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}">
                        @error('first_name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <label class="form-label required" for="gender">性別</label>
                <div class="form-field">
                    <div class="gender-field">
                        <label><input type="radio" name="gender" value="1"
                                {{ old('gender') == '1' ? 'checked' : '' }}>
                            男性</label>
                        <label><input type="radio" name="gender" value="2"
                                {{ old('gender') == '2' ? 'checked' : '' }}>
                            女性</label>
                        <label><input type="radio" name="gender" value="3"
                                {{ old('gender') == '3' ? 'checked' : '' }}>
                            その他</label>
                    </div>
                    @error('gender')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label required" for="email">メールアドレス</label>
                <div class="form-field">
                    <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label required" for="tel">電話番号</label>
                <div class="form-field tel-field">
                    <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}"> - 
                    <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}"> - 
                    <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                    @error('tel')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label required" for="address">住所</label>
                <div class="form-field">
                    <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                    @error('address')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label" for="building">建物名</label>
                <div class="form-field">
                    <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}">
                    @error('building')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label required" for="category_id">お問い合わせの種類</label>
                <div class="form-field">
                    <div class="select-wrapper">
                        <select name="category_id">
                            <option value="">選択してください</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <label class="form-label required" for="detail">お問い合わせ内容</label>
                <div class="form-field">
                    <textarea class="contact-textarea" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    @error('detail')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="confirm-row">
                <button type="submit" class="confirm-btn">確認画面</button>
            </div>
        </form>
    </div>
@endsection
