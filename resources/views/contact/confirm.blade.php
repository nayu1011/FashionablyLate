<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>確認画面 - FashionablyLate</title>
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
        .confirm-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .confirm-table tr {
            border-bottom: 1px solid #e0e0e0;
        }
        .confirm-table th {
            text-align: left;
            padding: 15px 10px;
            background-color: #f9f9f9;
            font-weight: bold;
            font-size: 14px;
            width: 30%;
        }
        .confirm-table td {
            padding: 15px 10px;
            font-size: 14px;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .submit-button {
            background-color: #333;
            color: #fff;
            padding: 12px 40px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .submit-button:hover {
            background-color: #555;
        }
        .back-button {
            background-color: #fff;
            color: #333;
            padding: 12px 40px;
            border: 1px solid #333;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FashionablyLate</h1>
    </div>

    <div class="container">
        <h2 class="form-title">内容確認</h2>

        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>{{ $contact['first_name'] }} {{ $contact['last_name'] }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @if($contact['gender'] == 1)
                        男性
                    @elseif($contact['gender'] == 2)
                        女性
                    @else
                        その他
                    @endif
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $contact['email'] }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $contact['tel'] }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $contact['address'] }}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>{{ $contact['building'] ?? '' }}</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>{{ $contact['content'] }}</td>
            </tr>
        </table>

        <div class="button-group">
            <form action="{{ route('contact.store') }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                <input type="hidden" name="email" value="{{ $contact['email'] }}">
                <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
                <input type="hidden" name="address" value="{{ $contact['address'] }}">
                <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
                <input type="hidden" name="content" value="{{ $contact['content'] }}">
                <button type="submit" class="submit-button">送信</button>
            </form>

            <form action="{{ route('contact.index') }}" method="GET" style="display: inline;">
                <button type="submit" class="back-button">修正</button>
            </form>
        </div>
    </div>
</body>
</html>
