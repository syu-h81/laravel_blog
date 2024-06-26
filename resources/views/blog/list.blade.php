@extends('layout')
@section('title', 'ブログ一覧')
@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-2">
    <h2>ブログ記事一覧</h2>
    @if (session('error')) 
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif
    @if (session('blog_register_msg')) 
      <div class="alert alert-danger">
        {{ session('blog_register_msg') }}
      </div>
    @endif
    @if (session('blog_update_msg')) 
      <div class="alert alert-danger">
        {{ session('blog_update_msg') }}
      </div>
    @endif
    @if (session('blog_delete_msg')) 
      <div class="alert alert-danger">
        {{ session('blog_delete_msg') }}
      </div>
    @endif
    <table class="table table-striped">
      <tr>
        <th>記事番号</th>
        <th>タイトル</th>
        <th>日付</th>
        <th></th>
        <th></th>
      </tr>
      @foreach($blogs as $blog)
      <tr>
        <td>{{ $blog->id }}</td>
        <td><a href="/blog/{{ $blog->id }}">{{ $blog->title }}</a></td>
        <td>{{ $blog->updated_at }}</td>
        <td>
          <button type="button" class="btn btn-primary" onclick="location.href='/blog/edit/{{ $blog->id }}'">編集</button>
        </td>
        <td>
          <form method="POST" action="{{ route('delete', $blog->id) }}" onSubmit="return checkDelete()">
          @csrf
            <button type="submit" class="btn btn-primary" onclick="">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
<script>
  function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
      return true;
    } else {
      return false;
    }
  }
</script>
@endsection