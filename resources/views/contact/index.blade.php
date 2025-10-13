<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ - FashionablyLate</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
        }
        .header {
            background-color: #fff;
            padding: 20px 0;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }
        .header h1 {
            font-size: 24px;
            font-weight: bold;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 14px;
        }
        .required {
            color: #ff0000;
            margin-left: 5px;
        }
        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-input:focus {
            outline: none;
            border-color: #666;
        }
        .form-textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            min-height: 100px;
            resize: vertical;
        }
        .gender-group {
            display: flex;
            gap: 20px;
        }
        .gender-option {
            display: flex;
            align-items: center;
        }
        .gender-option input[type="radio"] {
            margin-right: 5px;
        }
        .tel-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .tel-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .tel-separator {
            font-size: 18px;
            color: #666;
        }
        .error-message {
            color: #ff0000;
            font-size: 12px;
            margin-top: 5px;
        }
        .submit-button {
            background-color: #333;
            color: #fff;
            padding: 12px 40px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            margin: 30px auto 0;
        }
        .submit-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FashionablyLate</h1>
    </div>

    <div class="container">
        <h2 class="form-title">お問い合わせ</h2>

        <form action="{{ route('contact.confirm') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">お名前<span class="required">※</span></label>
                <div style="display: flex; gap: 10px;">
                    <input type="text" name="first_name" class="form-input" placeholder="例: 山田" value="{{ old('first_name') }}" style="flex: 1;">
                    <input type="text" name="last_name" class="form-input" placeholder="例: 太郎" value="{{ old('last_name') }}" style="flex: 1;">
                </div>
                @error('first_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                @error('last_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">性別<span class="required">※</span></label>
                <div class="gender-group">
                    <label class="gender-option">
                        <input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
                        男性
                    </label>
                    <label class="gender-option">
                        <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                        女性
                    </label>
                    <label class="gender-option">
                        <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
                        その他
                    </label>
                </div>
                @error('gender')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">メールアドレス<span class="required">※</span></label>
                <input type="email" name="email" class="form-input" placeholder="例: test@example.com" value="{{ old('email') }}">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">電話番号<span class="required">※</span></label>
                <input type="tel" name="tel" class="form-input" placeholder="080-1234-5678" value="{{ old('tel') }}">
                @error('tel')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">住所<span class="required">※</span></label>
                <input type="text" name="address" class="form-input" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                @error('address')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">建物名</label>
                <input type="text" name="building" class="form-input" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
                @error('building')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">お問い合わせ内容<span class="required">※</span></label>
                <textarea name="content" class="form-textarea" placeholder="お問い合わせ内容をご記入ください">{{ old('content') }}</textarea>
                @error('content')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="submit-button">確認画面</button>
        </form>
    </div>
</body>
</html>
