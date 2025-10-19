<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\log;

class AdminController extends Controller
{
    //管理画面
    public function index(Request $request)
    {
        $query = Contact::with('category');

        // 名前・メール検索（部分一致・フルネーム）
        if ($request->filled('keyword'))
        {
            $keyword = $request->input('keyword');
            
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"])
                  ->orWhere('email', 'like', "%{$keyword}%");

            });
        }

        //性別検索
        if ($request->filled('gender') && $request->input('gender') !== 'all')
        {
            $query->where('gender', $request->input('gender'));
        }

        //カテゴリ検索（category_id）
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        //日付検索
        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->input('created_at'));
        }

        //検索絞り込み分のCSVエクスポート
        if ($request->has('export')){
            $contacts = $query->get();
            return $this->export($contacts);
        }

        //カテゴリ一覧を取得してビューへ渡す
        $categories = Category::all();
        //登録が新しい順に7件ずつ表示
        $contacts = $query->orderby('id', 'desc')->paginate(7);

        return view('admin.index', compact('contacts', 'categories'));
    }

    //詳細画面
    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return response()->json($contact);
    }

    //削除処理
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return response()->json(['message' => '削除しました']);
    }

    //CSVエクスポート
    public function export($contacts = null)
    {
        // ファイル名の設定
        $fileName = 'contacts_' . date('Ymd_His') . '.csv';

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // ヘッダー行の追加
            fputcsv($handle, ['ID', '姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容', '作成日']);


            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->last_name,
                    $contact->first_name,
                    $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    optional($contact->category)->content,
                    $contact->detail,
                    $contact->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', "attachment; filename={$fileName}");

        return $response;
    }
}
