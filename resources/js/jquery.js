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
				let newTable = $(data).find('.table');
				//差し替える検索結果
				$('.table').html(newTable);
			
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


//悪くはなかったので次悪ければコメントアウトを戻す！！！！！！！！！！！！！

// 	$(function() {
//     $('.search').on('click',function (event) {
//         // リロードを阻止する
//         event.preventDefault();

//         // 検索データの取得
//         let searchData = $('#searchForm').serialize();
//         // ソートの情報を取得
//         let sortInfo = getSortInfo(); // ソート情報を取得するカスタムした関数
//         // 検索クエリとソート情報の結合
//         let requestData = searchData + '&' + sortInfo;

//         $.ajax({
//             url: 'product/search',
//             type: 'GET',
//             data: requestData,
//             dataType: 'html'
//         }).done(function(data) {
//             // 検索結果のtableがnewTableに入れる
//             let newTable = $(data).find('.table');
//             // 差し替える検索結果
//             $('.table').html(newTable);
        
//         }).fail(function(data) {
//             alert('通信失敗');
//         });
//     });

//     function getSortInfo() {
//         let sortInfo = [];
//         $('.table th').each(function(index) {
//             let sorter = $(this).data('sorter');
//             sortInfo.push('sort[' + index + ']=' + sorter);
//         });
//         return sortInfo.join('&');
//     }
// });


	// $(function() {
	// 	$('#sorter').tablesorter({
	// 		headers: {
	// 			0: { sorter: "digit"},
	// 			1: { sorter: "text"},
	// 			2: { sorter: "text"},
	// 			3: { sorter: "digit"},
	// 			4: { sorter: "digit"},
	// 			5: { sorter: "text"},
	// 		}
	// 	});
	// });

	//削除
	$(function() {
		$('.btn_s').on('click', function(event) {
			event.preventDefault();

			//クリックした情報を入れる
			let clickEle = $(this);
			let deleteId = clickEle.attr('data-delete_id');

			$.ajax({

				type: 'POST',
				url: 'delete/' + deleteId,
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