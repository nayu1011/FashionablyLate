# お問い合わせフォーム実装詳細

## 実装内容

### 1. データベース構造

#### contactsテーブル
- `id`: 主キー
- `first_name`: 姓
- `last_name`: 名
- `gender`: 性別 (1: 男性, 2: 女性, 3: その他)
- `email`: メールアドレス
- `tel`: 電話番号
- `address`: 住所
- `building`: 建物名 (任意)
- `content`: お問い合わせ内容 (120文字まで)
- `created_at`: 作成日時
- `updated_at`: 更新日時

### 2. ルート構成

| メソッド | URI | アクション | 説明 |
|---------|-----|---------|------|
| GET | / | ContactController@index | お問い合わせフォーム表示 |
| POST | /confirm | ContactController@confirm | 確認画面表示 |
| POST | /thanks | ContactController@store | データ保存 |
| GET | /thanks | ContactController@thanks | 送信完了画面 |

### 3. 画面構成

#### 3.1 お問い合わせフォーム (`resources/views/contact/index.blade.php`)
- 必須項目: 姓名、性別、メールアドレス、電話番号、住所、お問い合わせ内容
- 任意項目: 建物名
- バリデーション: クライアント側とサーバー側の両方で実施
- エラーメッセージ表示機能

#### 3.2 確認画面 (`resources/views/contact/confirm.blade.php`)
- 入力内容の確認
- 修正ボタン（フォームに戻る）
- 送信ボタン（データベースに保存）

#### 3.3 送信完了画面 (`resources/views/contact/thanks.blade.php`)
- 送信完了メッセージ
- トップページへのリンク

### 4. バリデーションルール

```php
'first_name' => 'required|string|max:255',
'last_name' => 'required|string|max:255',
'gender' => 'required|integer|in:1,2,3',
'email' => 'required|email|max:255',
'tel' => 'required|string|max:255',
'address' => 'required|string|max:255',
'building' => 'nullable|string|max:255',
'content' => 'required|string|max:120',
```

### 5. テスト

#### テストケース
1. `test_contact_form_displays_successfully`: フォームが正常に表示される
2. `test_contact_form_validation_requires_fields`: 必須フィールドのバリデーション
3. `test_contact_form_submits_successfully`: フォーム送信とデータベース保存

### 6. Docker環境

- `docker-compose.yml`: Docker Compose設定
- `Dockerfile`: PHPコンテナ設定
- `docker/nginx/conf.d/app.conf`: Nginx設定

## 使用方法

### 開発環境

```bash
# 依存関係をインストール
composer install

# 環境変数を設定
cp .env.example .env
php artisan key:generate

# データベースをマイグレーション
php artisan migrate

# 開発サーバーを起動
php artisan serve
```

### Docker環境

```bash
# コンテナを起動
docker-compose up -d

# アプリケーションにアクセス
# http://localhost:8080
```

### テスト実行

```bash
php artisan test
```

## 技術スタック

- Laravel 12.x
- PHP 8.3
- SQLite (開発環境)
- MySQL 8.0 (Docker環境)
- Nginx
- Docker & Docker Compose
