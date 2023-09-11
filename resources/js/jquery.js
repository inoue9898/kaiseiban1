	//検索非同期処理
	$(function() {

		$('.search').on('click',function (event) {
			//リロードを阻止する
			event.preventDefault();
			$.ajax({
				url: 'search',
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

	// $(function() {
	// 	$('.sort').on('click', function(event) {
	// 		event.preventDefault();
	// 		$.ajax({
	// 			url: '/list',
	// 			type: 'GET',
	// 			data: $('#tableList'),
	// 			dataType: 'html'

	// 		}).done(function(data) {
	// 			let newTableData = generateNewTableData();
	// 			$('.table').html(newTableData)

	// 		}).fail(function(data) {
	// 			alert('通信失敗');
	// 		})
	// 	});
	// });

	//削除
	// $(function() {

	// 	$('.btn_s').on('click',function (event) {
	// 		//リロードを阻止する
	// 		event.preventDefault();
	// 		$.ajax({
	// 			url: '/product/delete/' + itemId,
	// 			type: 'delete',
	// 			data: $('#deleteForm').serialize(),//formの中身を送る。
	// 			dataType: 'html'
				
	// 			//dataを受け取る
	// 		}).done(function(data) {
	// 			//検索結果のtableがnewTableに入れる
	// 			let newTable = $(data).find('.table')
	// 			//差し替える検索結果
	// 			$('.table').html(newTable)
			
	// 		}).fail(function(data) {
	// 			alert('通信失敗');
	// 		});
	// 	});
	// });