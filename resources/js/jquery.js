$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
	
	//検索非同期処理
	$(function() {

		$('.search').on('click',function (event) {
			//リロードを阻止する
			event.preventDefault();
			$.ajax({
				url: 'product/search',
				type: 'GET',
				data: $('#searchForm').serialize(),//formの中身を送る。
				dataType: 'html'
				
				//dataを受け取る
			}).done(function(data) {
				//検索結果のtableがnewTableに入れる
				let newTable = $(data).find('.table')
				//差し替える検索結果
				$('.table').html(newTable)
			
			}).fail(function(data) {
				alert('通信失敗');
			});
		});
	});

	//削除
	$(function() {
		$('.btn_s').on('click', function(event) {
			event.preventDefault();

			//クリックした情報を入れる
			let clickEle = $(this);
			let deleteId = clickEle.attr('data-delete_id');

			$.ajax({

				type: 'POST',
				url: 'product/delete/' + deleteId,
				dataType: 'html',
				data: {'id': deleteId, '_method': 'DELETE'}

			}).done(function() {

				clickEle.parents('tr').remove();

			}).fail(function() {

				alert('通信失敗');

			});
		});
	});

// ソート機能
// $(document).ready(function () {
// 	// テーブルヘッダーのクリックハンドラ
// 	$('th[data-sortable]').on('click', function () {
// 			var columnName = $(this).data('sortable'); // クリックされたヘッダーのソート対象カラム名

// 			// ソートリクエストをサーバーに送信
// 			$.ajax({
// 					type: 'GET',
// 					url: "sort", // 現在のURLにソートクエリを追加
// 					data: { sort: columnName }, // ソートカラム名を送信
// 					dataType: 'html',
// 			}).done(function(data){
// 					let newTable = $(data).find('.table')
// 					$('.table').html(newTable)
// 			}).fail(function(data) {
// 					alert('通信失敗');
// 			});
// 	});
// });