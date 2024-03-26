<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    //ブログ一覧画面表示
    public function showList() {
        $blogs = Blog::all();
        return view('blog.list', ['blogs' => $blogs]);
    }

    /**
     * ブログ詳細を表示する
     * @param int $id
     * @return view
     */
    public function showDetail($id) {
        $blog = Blog::find($id);
        if (is_null($blog)) {
            return redirect()->route('blogs')->with('error', 'データがありません');
        }
        return view('blog.detail', ['blog' => $blog]);
    }

    /**
     * ブログ登録画面の表示
     * @return view
     */
     public function showCreate() {
        return view('blog.form');
     }

     /**
     * ブログ登録機能の実装
     * @return view
     */
    public function exeStore(BlogRequest $request) {
        //ブログのデータ受け取る
        $inputs = $request->all();
        try {
            //ブログを登録
            Blog::create($inputs);
            DB::commit();
        } catch(\Throwable $e) {
            DB::rollback();
            abort(500);
        }
        return redirect()->route('blogs')->with('blog_register_msg', 'ブログを登録しました');
     }

     /**
     * ブログ編集画面を表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id) {
        $blog = Blog::find($id);
        if (is_null($blog)) {
            return redirect()->route('blogs')->with('error', 'データがありません');
        }
        return view('blog.edit', ['blog' => $blog]);
    }

    /**
     * ブログ編集機能の実装
     * @return view
     */
    public function exeUpdate(BlogRequest $request) {
        //ブログのデータ受け取る
        $inputs = $request->all();
        try {
            //ブログを更新
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $blog->save();
            DB::commit();
        } catch(\Throwable $e) {
            DB::rollback();
            abort(500);
        }
        return redirect()->route('blogs')->with('blog_update_msg', 'ブログを更新しました');
     }

     /**
     * ブログ削除機能の実装
     * @param int $id
     * @return view
     */
    public function exeDelete($id) {
        if (empty($id)) {
            return redirect()->route('blogs')->with('error', 'データがありません');
        }
        try {
            //ブログを更新
            Blog::destroy($id);
            DB::commit();
        } catch(\Throwable $e) {
            abort(500);
        }
        return redirect()->route('blogs')->with('blog_delete_msg', 'ブログを削除しました');
    }
}
