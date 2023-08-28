	$(function() {
		$('input .search').on('click',function () {
			$.ajax({
				url: '/product/public/list',
				type: 'GET',
				dataType: 'html'
				
			}).done(function(data) {
				$('.table1').html(data);

			}).fail(function(data) {
				alert('通信失敗');
			});
		});
	});
