@extends('layouts.app')

@section('content')
		<div>
			<h2>商品情報詳細</h2>
		</div>
		<div>
			<a class="btn btn-success" href="{{ url('/list') }}">戻る</a>
		</div>

<div>
	@csrf


		<table class="form-group">
			<div class="form-group">
				<tr><th>ID:</th><td>{{ $product->id }}</td></tr>
			</div>
			<div class="form-group">
				 <tr><th>画像</th><td><img class="img" src="{{ asset('storage/'.$product->img_path)}}"></td></tr>
			</div>
			<div class="form-group">
				<tr><th>商品名:</th><td>{{ $product->product_name }}</td></tr>
			</div>
			<div class="form-group">
				<tr><th>メーカー名:</th><td>{{ $product->company_name }}</td></tr>
			</div>
			<div class="form-group">
				<tr><th>価格:</th><td>{{ $product->price }}</td></tr>
			</div>
			<div class="form-group">
				<tr><th>在庫:</th><td>{{ $product->stock }}</td></tr>
			</div>
			<div class="form-group">
				<tr><th>コメント:<td>{{ $product->comment }}</td></tr>
			</div>
		</table>
		<span class="ml-auto">
		<a class="btn_e" href="{{ route('product.edit',$product->id) }}">編集</a>

		</span>
	</div>
</div>
@endsection