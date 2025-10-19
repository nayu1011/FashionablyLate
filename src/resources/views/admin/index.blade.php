@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="admin-container">
        <h1 class="admin-title">Admin</h1>
        {{-- 検索フォーム --}}
        <form action="{{ route('admin.index') }}" method="GET" class="search-form">
            {{-- 名前 or メール --}}
            <input type="text" name="keyword" class="search-input" placeholder="名前やメールアドレスを入力してください"
                value="{{ request('keyword') }}">

            {{-- 性別 --}}
            <div class="select-wrapper">
                <select name="gender" class="search-select">
                    <option value="">性別</option>
                    <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>全て</option>
                    <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
                </select>
            </div>
            {{-- お問い合わせの種類 --}}
            <div class="select-wrapper">
                <select name="category_id" class="search-select">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- 日付 --}}
            <input type="date" name="created_at" class="search-date" value="{{ request('created_at') }}">

            {{-- 検索 --}}
            <button type="submit" class="search-btn">検索</button>
            {{-- リセット --}}
            <a href="{{ route('admin.index') }}" class="reset-btn">リセット</a>
        </form>

        <div class="admin-toolbar">
            {{-- CSVエクスポート --}}
            <form action="{{ route('admin.index') }}" method="GET" class="export-form">
                {{-- 検索条件を引き継ぐ --}}
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                <input type="hidden" name="search-date" value="{{ request('created_at') }}">
                <button type="submit" name="export" value="1" class="export-btn">エクスポート</button>
            </form>
            {{-- 右端にページネーション --}}
            <div class="pagination-top">
                {{-- クエリ維持してページング --}}
                {{ $contacts->withQueryString()->onEachSide(1)->links('vendor.pagination.fashionably') }}
            </div>
        </div>
        {{-- 一覧表示 --}}
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                            <td>
                                @if ($contact->gender == '1')
                                    男性
                                @elseif($contact->gender == '2')
                                    女性
                                @else
                                    その他
                                @endif
                            </td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->category->content ?? '未設定' }}</td>
                            <td><button class="detail-btn" data-id="{{ $contact->id }}">詳細</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- モーダル --}}
        <div class="modal" id="detailModal">
            <div class="modal-content">
                <span class="close-btn" id="closeModal">&times;</span>
                <div class="modalBody">
                    <table>
                        <tr>
                            <th>お名前</th>
                            <td><span id="modal-name"></span></td>
                        </tr>
                        <tr>
                            <th>性別</th>
                            <td><span id="modal-gender"></span></td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td><span id="modal-email"></span></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td><span id="modal-tel"></span></td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td><span id="modal-address"></span></td>
                        </tr>
                        <tr>
                            <th>建物名</th>
                            <td><span id="modal-building"></span></td>
                        </tr>
                        <tr>
                            <th>お問い合わせの種類</th>
                            <td><span id="modal-category"></span></td>
                        </tr>
                        <tr>
                            <th>お問い合わせ内容</th>
                            <td><span id="modal-detail"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button id="deleteBtn" class="delete-btn">削除</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('detailModal');
            const closeBtn = document.querySelector('.close-btn');
            const deleteBtn = document.getElementById('deleteBtn');
            let currentId = null;

            // 詳細ボタン押下時
            document.querySelectorAll('.detail-btn').forEach(btn => {
                btn.addEventListener('click', async (e) => {
                    const id = e.target.dataset.id;
                    currentId = id;

                    const response = await fetch(`/admin/${id}`);
                    const data = await response.json();

                    document.getElementById('modal-name').textContent =
                        `${data.last_name} ${data.first_name}`;
                    document.getElementById('modal-gender').textContent =
                        data.gender == 1 ? '男性' : data.gender == 2 ? '女性' : 'その他';
                    document.getElementById('modal-email').textContent = data.email;
                    document.getElementById('modal-tel').textContent = data.tel;
                    document.getElementById('modal-address').textContent = data.address;
                    document.getElementById('modal-building').textContent = data.building ?? '';
                    document.getElementById('modal-category').textContent = data.category
                        .content;
                    document.getElementById('modal-detail').textContent = data.detail;

                    modal.style.display = 'block';
                });
            });

            // 閉じるボタン
            closeBtn.onclick = () => modal.style.display = 'none';
            window.onclick = (e) => {
                if (e.target == modal) modal.style.display = 'none';
            }

            // 削除ボタン
            deleteBtn.addEventListener('click', async () => {
                if (!confirm('本当に削除しますか？')) return;

                const response = await fetch(`/admin/${currentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .content
                    }
                });

                if (response.ok) {
                    alert('削除しました');
                    location.reload();
                } else {
                    alert('削除に失敗しました');
                }
            });
        });
    </script>
@endsection
