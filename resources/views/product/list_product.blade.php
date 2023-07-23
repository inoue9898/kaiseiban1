@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif

	<div class="row">
		<div class="col-lg-12">
			<div class="text-left">
				<h2 style="font-size:1rem;">商品一覧</h2>
			</div>
			<div class="text-right">
			<a class="btn btn-success" href="{{ route('product.create') }}">新規登録</a>
			</div>
		</div>
	</div>

	<div>
	<form action="{{ route('list_product') }}" method="GET">
		
		<select name="company_name">
			<option value="">メーカー名</option>
			@foreach($companies as $company)
				<option value="{{ $company->id }}">{{ $company->company_name }}</option>
			@endforeach
		</select>

		<input type="text" name="keyword" placeholder="商品名">
		<input type="submit" value="検索">
	</form>
	</div>

	<div class="table-responsive">
	<table class="table table-borderd" style="width: 1000px max-width: 0 auto;">
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
				<td style="text-align:center">
					<a class="btn btn-primary" href="{{ route ('product.detail',$product->id) }}">詳細</a>
				</td>
				<td>
					<form action="{{ route('product.delete', $product->id) }}" method="POST">
						@csrf
						@method('delete')
						<button type="submit" class="btn btn-danger" onclick="return confirm('削除しますか？')">削除</button>
					</form>
				</td>
		</tr>
		@endforeach
	</div>
</div>
</table>
<div class="d-flex justify-content-center">

</div>
	@endsection



