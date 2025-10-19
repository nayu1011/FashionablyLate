<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    //お問い合わせフォーム入力ページ
    public function index(){
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    //お問い合わせフォーム確認ページ
    public function confirm(ContactRequest $request){
        $inputs = $request->validated();

        $inputs['tel'] = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');
        //修正ボタン押下時
        if ($request->input('action') === 'back') {
            return redirect(route('contact.index'))
                ->withInput();
        }

        return view('contact.confirm', compact('inputs'));
    }

    public function thanks(Request $request)
    {
        // POST以外で来たらリダイレクト
        if (!$request->isMethod('post')) {
            return redirect()->route('contact.index');
        }

        // 「戻る」ボタン対策（直接アクセス禁止）
        if (!$request->has('last_name')) {
            return redirect()->route('contact.index');
        }

        // データ登録
        Contact::create($request->except(['_token', 'action']));

        // 完了ページ表示
        return view('contact.thanks');    
    }
}
