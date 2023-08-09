<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
<p id="test"> Hello world </p>
	<!-- Add this script to your view or layout -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    // Initialize Pusher with your credentials
	console.log("hello world")
    const pusher = new Pusher('dae5f00dabb5f453ee70', {
        cluster: 'ap1',
    });

    // Subscribe to the binance-chart-updates channel
    const channel = pusher.subscribe('binance-chart-updates');
    channel.bind('binance-chart-update', function(data) {
       $('#test').html(data.chart.price);
    });
</script>
</body>
</html>

