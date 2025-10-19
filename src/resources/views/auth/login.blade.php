@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="login-container">
        <h2 class="login-title">Login</h2>
        <div class="form-login">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf
                <div>
                    <label class="form-label" for="email">メールアドレス</label>
                    <input class="form-input" id="email" type="email" name="email" placeholder="例:text@example.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="form-label" for="password">パスワード</label>
                    <input class="form-input" id="password" type="password" name="password" placeholder="例:coachtech1106">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="form-button">ログイン</button>
            </form>
        </div>
    </div>
@endsection
