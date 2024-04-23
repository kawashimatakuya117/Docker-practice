@extends('layouts.app')
@section('content')
@include('commons.errors')
<form action="{{route('products.store')}}" method="post">
    @include('products.form')
    <button type="submit">商品を追加する</button>
    <a href="{{route('products.index')}}">キャンセル</a>
</form>
@endsection