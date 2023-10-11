$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});


	//検索非同期処理　正解
	$(function() {

		$('#fav-table').tablesorter({
			headers: {
				 1: { sorter: false },
				 2: { sorter: false },
				 5: { sorter: false },
				 6: { sorter: false }
			},
		});


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
				$('.table').tablesorter({
					headers: {
						1: { sorter: false },
						2: { sorter: false },
						5: { sorter: false },
						6: { sorter: false }
				 }
				});
			
			}).fail(function(data) {
				alert('通信失敗');
			});
		});
	});

	$(function() {
    // 検索フォームの送信イベントをキャッチ
    $('#searchForm').on('submit', function(event) {
        event.preventDefault();

        // 検索フォームのデータを取得
        let searchData = $(this).serialize();

        // 選択されたソートリンクのデータを取得
        let sortColumn = $(this).data('sort');
        let sortDirection = $(this).data('sort-direction');

        // ソート条件をクエリ文字列に追加
        let queryParams = searchData + '&sort=' + sortColumn + '&direction=' + sortDirection;

        // サーバーにクエリ文字列を含めて検索リクエストを送信
        $.ajax({
            url: 'product/search',
            type: 'GET',
            data: queryParams,
            dataType: 'html'
        }).done(function(data) {
            // 検索結果を表示
            $('table tbody').html(data);
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

