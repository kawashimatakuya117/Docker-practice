@extends('layouts.app')
@section('content')
@include('commons.errors')
<form action="{{route('products.update',$product)}}" method="post">
    @method('patch')
    @include('products.form')
    <button type="submit">更新する</button>
</form>
<form onsubmit="return confirm('本当に削除しますか？')" action="{{route('products.destroy',$product)}}" method="post">
    @csrf
    @method('delete')
    <button type="submit">削除</button>
</form>
<a href="{{route('products.index',$product)}}">キャンセル</a>

@endsection