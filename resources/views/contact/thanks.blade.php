<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送信完了 - FashionablyLate</title>
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
            padding: 60px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        .thanks-message {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .thanks-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 40px;
        }
        .home-button {
            background-color: #333;
            color: #fff;
            padding: 12px 40px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .home-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FashionablyLate</h1>
    </div>

    <div class="container">
        <h2 class="thanks-message">お問い合わせありがとうございました！</h2>
        <p class="thanks-description">お問い合わせ内容を送信しました。<br>内容を確認次第、ご連絡させていただきます。</p>
        <a href="{{ route('contact.index') }}" class="home-button">トップページへ</a>
    </div>
</body>
</html>
