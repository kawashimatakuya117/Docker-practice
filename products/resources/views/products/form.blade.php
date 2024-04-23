@csrf
<dl class="form-list">
    <dt>カテゴリ</dt>
    <dd>
        <select name="category_id" class="form-select">
            <option value=""></option>
            @foreach (App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" {{ $category->id === (int)old('category_id',$product->category?->id) ? 'selected' : ''}}> {{ $category->name }} </option>
            @endforeach
        </select>
    </dd>
    <dt>メーカー</dt>
    <dd><input type="text" name="maker" value="{{old('maker',$product->maker)}}"></dd>
    <dt>商品名</dt>
    <dd><input type="text" name="name" value="{{old('name',$product->name)}}"></dd>
    <dt>値段</dt>
    <dd><input type="text" name="price" value="{{old('price',$product->price)}}"></dd>
</dl>