@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2 style="font-size:1rem;">商品編集画面</h2>
		</div>
		<div>
			<a class="btn btn-success" href="{{ url('/list') }}">戻る</a>
		</div>
	</div>
</div>

<div style="text-align:right;">
<form action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data" method="POST">
	@csrf
	@method('put')
	<div class="row">
		<div class="col-12 mb-2 mt-2">
			<div class="form-group" style="text-align:left;">
				{{ $product->id }}
			</div>
			<div class="form-group">
				<input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}">
				@error('product_name')
				<span style="color:red;">20文字以内で入力してください</span>
				@enderror
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				<select name="company_name" class="form-select">
					<option value="">メーカーを選択してください</option>
					@foreach ($companies as $company)
						<option value="{{ $company->id }}">{{ $company->company_name }}</option>
					@endforeach

				@error('company_name')
				<span style="color:red;">選択してください</span>
				@enderror
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				<input type="text" name="price" class="form-control" value="{{ $product->price }}">
				@error('price')
				<span style="color:red;">数値で入力してください</span>
				@enderror
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				<input type="text" name="stock" class="form-control" value="{{ $product->stock }}">
				@error('stock')
				<span style="color:red;">数値で入力してください</span>
				@enderror
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				<textarea class="form-control" style="height:100px" name="comment" class="form-control" value="{{ $product->comment }}"></textarea>
				@error('comment')
				<span style="color:red;">入力してください</span>
				@enderror
			</div>
		</div>
		<input type="file" name="image">
		<div class="col-12 mb-2 mt-2">
			<button type="submit" class="btn btn-primary w-100">更新</button>
		</div>
	</div>
</form>
</div>
@endsection