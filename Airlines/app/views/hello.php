<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<style>
		/*@import url(//fonts.googleapis.com/css?family=Lato:700);*/

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>

	{{ HTML::style('public/dist/css/vendor/bootstrap.min.css') }}

	<!-- Loading Flat UI -->
	{{ HTML::style('public/dist/css/flat-ui.css') }}
	{{ HTML::style('public/docs/assets/css/demo.css') }}

	{{ HTML::style('public/css/index.css') }}
</head>
<body>
	<div class="demo-headline">
        <h1 class="demo-logo">
          <div class="logo"></div>
          Flat UI
          <small>Free User Interface Kit</small>
        </h1>
      </div> <!-- /demo-headline -->
</body>
</html>
