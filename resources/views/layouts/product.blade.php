<html>
	<head>
			<style>
				table{
					width: 100%;
					border-spacing: 0;
				}

				table th{
					border-bottom: solid 2px #fb5144;
					padding: 10px 0;
				}

				table td{
					border-bottom: solid 2px #ddd;
					text-align: center;
					padding: 10px 0;
				}

				.content {margin:50px; }
			</style>
			<body>
				<div class="content">
					@yield('content')
				</div>
			</body>

	</head>
</html>