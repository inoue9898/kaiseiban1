@extends('layouts.app')

@section('content')
		<div>
			<h2>商品編集画面</h2>
		</div>
		<div>
			<a class="btn btn-success" href="{{ route ('product.detail',$product->id) }}">戻る</a>
		</div>

<div>
<form action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data" method="POST">
	@csrf
	@method('put')
			<div class="form-group">
				{{ $product->id }}
			</div>
			<div class="form-group">
				<input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}">
				@error('product_name')
				<span>20文字以内で入力してください</span>
				@enderror
			</div>
			<div class="form-group">
				<select name="company_name" class="form-select">
					<option value="">メーカーを選択してください</option>
					@foreach ($companies as $company)
						<option value="{{ $company->id }}">{{ $company->company_name }}</option>
					@endforeach

				@error('company_name')
				<span>選択してください</span>
				@enderror
			</div>
			<div class="form-group">
				<input type="text" name="price" class="form-control" value="{{ $product->price }}">
				@error('price')
				<span>数値で入力してください</span>
				@enderror
			</div>
			<div class="form-group">
				<input type="text" name="stock" class="form-control" value="{{ $product->stock }}">
				@error('stock')
				<span>数値で入力してください</span>
				@enderror
			</div>
			<div class="form-group">
				<textarea class="form-control" name="comment" class="form-control" value="{{ $product->comment }}"></textarea>
				@error('comment')
				<span>入力してください</span>
				@enderror
			</div>
		<input type="file" name="image" class="image">
		<div>
			<button type="submit" class="btn_up">更新</button>
		</div>
	</div>
</form>
</div>
@endsection