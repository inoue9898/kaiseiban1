@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2 style="font-size:1rem;">商品情報詳細</h2>
		</div>
		<div>
			<a class="btn btn-success" href="{{ url('/list') }}">戻る</a>
		</div>
	</div>
</div>

<div style="text-align:left;">
	@csrf

	<div class="row">
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				{{ $product->id }}
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				{{ $product->product_name }}
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				{{ $product->company->company_name }}
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				{{ $product->price }}
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				{{ $product->stock }}
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				{{ $product->comment }}
			</div>
		</div>
		<span class="ml-auto">
		<a class="btn btn-success" href="{{ route('product.edit',$product->id) }}">編集</a>

		</span>
	</div>
</div>
@endsection