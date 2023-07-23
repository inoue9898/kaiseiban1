@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12 margin-tb">
		<div class="pull-left">
			<h2 style="font-size:1rem;">商品登録画面</h2>
		</div>
		<div>
			<a class="btn btn-success" href="{{ url('/list') }}">戻る</a>
		</div>
	</div>
</div>

<div style="text-align:right;">
<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	<div class="row">
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				<input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" placeholder="商品名">
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
				</select>
				@error('company_name')
				<span style="color:red;">選択してください</span>
				@enderror
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				<input type="text" name="price" class="form-control" value="{{ old('price') }}" placeholder="価格">
				@error('price')
				<span style="color:red;">数値で入力してください</span>
				@enderror
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				<input type="text" name="stock" class="form-control" value="{{ old('stock') }}" placeholder="在庫数">
				@error('stock')
				<span style="color:red;">数値で入力してください</span>
				@enderror
			</div>
		</div>
		<div class="col-12 mb-2 mt-2">
			<div class="form-group">
				<textarea class="form-control" style="height:100px" name="comment" class="form-control" placeholder="コメント">{{ old('comment') }}</textarea>
				@error('comment')
				<span style="color:red;">入力してください</span>
				@enderror
			</div>
		</div>

		<form action="{{ route('product.store') }}" enctype="multipart/form-data" method="POST"> 
				@csrf
				<input type="file" name="image">
				@error('image')
				<span style="color:red;">画像を選択してください</span>
				@enderror
 		</form>

		<div class="col-12 mb-2 mt-2">
			<button type="submit" class="btn btn-primary w-100">登録</button>
		</div>
	</div>
</form>
</div>
@endsection