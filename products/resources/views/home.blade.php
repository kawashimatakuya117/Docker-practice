@extends('layouts.app')
@section('content')
<h1>マイページ</h1>
<p>ようこそ、{{ Auth::user()->name }}さん</p>
<p><a href="{{ route('products.index') }}">商品一覧へ</a></p>
<p><a href="{{ route('products.create') }}">商品管理へ</a></p>
<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">ログアウト</button>
</form>
@endsection()