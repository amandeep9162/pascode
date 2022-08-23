<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
	
</style>
</head>
<body>
  <img src="{{asset('200.gif')}}" id="loading-image" class="hide" width="40" style="position: absolute; /* text-align: center; */ padding: -10px; margin: 19%; background: #ff00004a; background-image: red; color: #ff000008; top: 46px; padding: 20px; width: 183px; right: 327px; z-index: 9999999;"> <div class="container" style="margin-top: 15px;"> 
  	@yield('content')
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script >
	$(document).ready(function(){
		$('#success-message').hide();
		$('#loading-image').hide();
	});

</script>
    @yield('addjavascript')
</body>
</html>