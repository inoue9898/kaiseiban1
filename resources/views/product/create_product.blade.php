@extends('layouts.app')

@section('content')
<div>
	<div>
		<div>
			<h2>商品登録画面</h2>
		</div>
		<div>
			<a class="btn" href="{{ url('/list') }}">戻る</a>
		</div>
	</div>
</div>

<div>
<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

			<div class="form-group">
				<input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" placeholder="商品名">
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
				</select>
				@error('company_name')
				<span>選択してください</span>
				@enderror
			</div>
			<div class="form-group">
				<input type="text" name="price" class="form-control" value="{{ old('price') }}" placeholder="価格">
				@error('price')
				<span>数値で入力してください</span>
				@enderror
			</div>
			<div class="form-group">
				<input type="text" name="stock" class="form-control" value="{{ old('stock') }}" placeholder="在庫数">
				@error('stock')
				<span>数値で入力してください</span>
				@enderror
			</div>
			<div class="form-group">
				<textarea class="form-control" style="height:100px" name="comment" class="form-control" placeholder="コメント">{{ old('comment') }}</textarea>
				@error('comment')
				<span>入力してください</span>
				@enderror
			</div>
	<div class="custom-image">
		<form action="{{ route('product.store') }}" enctype="multipart/form-data" method="POST"> 
				@csrf
				<input type="file" name="image" class="image">
				@error('image')
				<span>画像を選択してください</span>
				@enderror
	</div>

		<div>
			<button type="submit" class="btn_sub">登録</button>
		</div>
		</form>
</form>
</div>
@endsection