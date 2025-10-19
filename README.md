# アプリケーション名
FashionablyLate（お問い合わせフォーム）

## 概要
FashionablyLateでは、お問い合わせ内容を contacts テーブルで管理しています。
各お問い合わせは categories テーブルの「お問い合わせ種別」と紐付きます。
管理者（users）は Fortify により認証、問い合わせ一覧を管理画面から閲覧・削除可能です。
管理者としてログインするには、http://localhost/register にアクセスして
お名前・メールアドレス・パスワードを登録してください。

## 環境構築

Docker ビルド
1. git clone https://github.com/nayu1011/FashionablyLate.git
2. docker compose up -d --build

＊MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

Laravel環境構築
1. docker compose exec php bash
2. composer install
3. .env.exampleファイルから.envを作成し、環境変数を変更
4. php artisan key:generate
5. php artisan migrate
6. phpartisan db:seed


## 使用技術(実行環境)
php 8.1
Laravel  8.83.29
MySQL 8.0.26
nginx 1.21.1

## ER図
README.mdと同じディレクトリにあるer.pngを参照してください。

## URL
開発環境：http://localhost/
phpMyAdmin：http://localhost:8080/