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
