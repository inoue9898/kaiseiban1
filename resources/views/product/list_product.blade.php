@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif

			<div>
				<h2 class="h2">商品一覧</h2>
			</div>
			<div>
			<a class="btn_st" class1="btn1" href="{{ route('product.create') }}">新規登録</a>
			</div>

	<div class="company">
	<form id="searchForm" action="{{ route('product.search') }}" method="GET">
	@csrf
		<select name="company_name">
			<option value="">メーカー名</option>
			@foreach($companies as $company)
				<option value="{{ $company->id }}">{{ $company->company_name }}</option>
			@endforeach
		</select>

		<input type="text" class="product" name="keyword" placeholder="商品名">
		<input type="text" class="price" name="min_price" placeholder="価格下限~">
		<input type="text" class="price" name="max_price" placeholder="価格上限">

		<input type="text" class="stock" name="min_stock" placeholder="在庫下限~">
		<input type="text" class="stock" name="max_stock" placeholder="在庫上限">

		<input type="submit" class="search" value="検索">
	</form>
	</div>

	<div class="table1">
	<table id="productTable" class="table">
		<tr name="sort">
			<th>商品ID</th>
			<th>商品画像</th>
			<th>商品名</th>
			<th scope="col">@sortablelink('price', '価格')</th>
			<th scope="col">@sortablelink('stock', '在庫数')</th>

			<!-- <th id="sort_by">
				価格
				</th>
			<th id="sort_by">
				在庫数
			</th> -->
			<th>メーカー名</th>
		</tr>
		@foreach ($products as $product)
		<tr>
				<td scope="row">{{ $product->id }}</td>
				<td><img src="{{ asset('storage/'.$product->img_path)}}"></td>
				<td>{{ $product->product_name }}</td>
				<td>{{ $product->price }}</td>
				<td>{{ $product->stock }}</td>
				<td>{{ $product->company_name }}</td>
				<td>
					<a class="btn_d" href="{{ route ('product.detail',$product->id) }}">詳細</a>
				</td>
				<td>
					<form id="deleteForm" action="{{ route('product.delete', $product->id) }}" method="POST">
						@csrf
						@method('delete')
						<button type="submit" class="btn_s" onclick="return confirm('削除しますか？')">削除</button>
					</form>
				</td>
		</tr>
		@endforeach
	</div>
</div>
</table>
	@endsection



