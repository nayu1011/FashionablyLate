@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
        <div class="register-container">
            <h2 class="register-title">Register</h2>
            <div class="form-register">
                <form method="POST" action="{{ route('register') }}" novalidate>
                    @csrf
                    <div>
                        <label class="form-label" for="name">お名前</label>
                        <input class="form-input" id="name" type="text" name="name" placeholder="例:山田　太郎" value="{{ old('name') }}">
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label" for="email">メールアドレス</label>
                        <input class="form-input" id="email" type="email" name="email" placeholder="例:text@example.com" value="{{ old('email') }}">
                        @error('email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="form-label" for="password">パスワード</label>
                        <input class="form-input" id="password" type="password" name="password" placeholder="例:coachtech1106">
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="form-button">登録</button>
                </form>
            </div>
        </div>
@endsection
