# FashionablyLate

Laravel development environment with Docker

## 概要

FashionablyLateは、お問い合わせフォームを持つLaravelアプリケーションです。

## 機能

- お問い合わせフォーム
  - 名前、性別、メールアドレス、電話番号、住所、建物名、お問い合わせ内容の入力
  - 入力内容の確認画面
  - データベースへの保存
  - 送信完了画面

## セットアップ

### 必要要件

- PHP 8.3以上
- Composer
- SQLite（開発環境）
- Docker & Docker Compose（本番環境用）

### インストール手順

1. リポジトリをクローン
```bash
git clone https://github.com/nayu1011/FashionablyLate.git
cd FashionablyLate
```

2. 依存関係をインストール
```bash
composer install
```

3. 環境変数ファイルをコピー
```bash
cp .env.example .env
```

4. アプリケーションキーを生成
```bash
php artisan key:generate
```

5. データベースをマイグレーション
```bash
php artisan migrate
```

6. 開発サーバーを起動
```bash
php artisan serve
```

アプリケーションは http://localhost:8000 でアクセスできます。

### Dockerを使用する場合

```bash
docker-compose up -d
```

アプリケーションは http://localhost:8080 でアクセスできます。

## テスト

```bash
php artisan test
```

## データベース構造

### contactsテーブル

| カラム名 | 型 | 説明 |
|---------|-----|------|
| id | bigint | 主キー |
| first_name | string | 名前（名） |
| last_name | string | 名前（姓） |
| gender | tinyint | 性別（1: 男性, 2: 女性, 3: その他） |
| email | string | メールアドレス |
| tel | string | 電話番号 |
| address | string | 住所 |
| building | string | 建物名（任意） |
| content | text | お問い合わせ内容（120文字まで） |
| created_at | timestamp | 作成日時 |
| updated_at | timestamp | 更新日時 |

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

