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


			<div class="form-group">
				{{ $product->id }}
			</div>
			<div class="form-group">
				{{ $product->product_name }}
			</div>
			<div class="form-group">
				{{ $product->company_name }}
			</div>
			<div class="form-group">
				{{ $product->price }}
			</div>
			<div class="form-group">
				{{ $product->stock }}
			</div>
			<div class="form-group">
				{{ $product->comment }}
			</div>
		<span class="ml-auto">
		<a class="btn btn-success" href="{{ route('product.edit',$product->id) }}">編集</a>

		</span>
	</div>
</div>
@endsection