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
	<form action="{{ route('product.search') }}" method="GET">
		
		<select name="company_name">
			<option value="">メーカー名</option>
			@foreach($companies as $company)
				<option value="{{ $company->id }}">{{ $company->company_name }}</option>
			@endforeach
		</select>

		<input type="text" class="product" name="keyword" placeholder="商品名">
		<input type="submit" class="search" value="検索">
	</form>
	</div>

	<div class="table1">
	<table class="table">
		<tr>
			<th>商品ID</th>
			<th>商品画像</th>
			<th>商品名</th>
			<th>価格</th>
			<th>在庫数</th>
			<th>メーカー名</th>
		</tr>
		@foreach ($products as $product)
		<tr>
				<td>{{ $product->id }}</td>
				<td><img src="{{ asset('storage/images/'.$product->img_path)}}"></td>
				<td>{{ $product->product_name }}</td>
				<td>{{ $product->price }}</td>
				<td>{{ $product->stock }}</td>
				<td>{{ $product->company_name }}</td>
				<td>
					<a class="btn_d" href="{{ route ('product.detail',$product->id) }}">詳細</a>
				</td>
				<td>
					<form action="{{ route('product.delete', $product->id) }}" method="POST">
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



