<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.21/sweetalert2.min.css" integrity="sha512-yX1R8uWi11xPfY7HDg7rkLL/9F1jq8Hyiz8qF4DV2nedX4IVl7ruR2+h3TFceHIcT5Oq7ooKi09UZbI39B7ylw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<p id="test"> Price Will Change When give command  </p>
<form onsubmit="withdrawMoney(event, '{{route('withdraw')}}')">
    <p> BTC/USDT : <span id="btc"> - </span> </p>
    <p> ETH/USDT : <span id="eth"> - </span> </p>
    <p> BNB/USDT : <span id="bnb"> - </span> </p>
    <p> SHIB/USDT : <span id="shib"> - </span> </p>
    <p> SOL/USDT : <span id="sol"> - </span> </p>
    <p> AKRO/USDT : <span id="akro"> - </span> </p>
    <input type="text" id="key" placeholder="generated_key" disabled>
    <button type="button" onclick="fetchKey(event, '{{route('keygenerate')}}')"> Generate Key </button> <hr>
    <input type="text" id="amount" placeholder="Enter Your Amount">
    <button type="submit"> Withdraw </button>
</form>
	<!-- Add this script to your view or layout -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.21/sweetalert2.min.js" integrity="sha512-MljqTsJt4qzUBMBjcvKamm1Ue6QD9QVBQxMd2j/yU0Q9X8ZmOTlBFY67x9IPkP7GCbuBMrNujN2gTwA5rrsKcw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // Initialize Pusher with your credentials
    const pusher = new Pusher('dae5f00dabb5f453ee70', {
        cluster: 'ap1',
    });

    // Subscribe to the binance-chart-updates channel
    const channel = pusher.subscribe('binance-chart-updates');
    channel.bind('binance-chart-update', function(res) {
        const data = res.data;
        for(const coin in data) {
            const price = data[coin];
           $(`#${coin}`).text(`${price}`)
        }
    });
    const channel2 = pusher.subscribe('generate-keys');
    channel2.bind('generate-key', function(data) {
       triggerButton(data.notification, 'success')
       $('#key').val(data.notification)
    });
</script>
    
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
    function fetchKey(e, url) {
        e.preventDefault();
        $.ajax({
            method : 'POST',
            url : url,
            success : function(res) {
                if(res.success) {
                    console.log("success");
                } else {
                    console.log("error")
                }
            }, 
            error : function(err, xhr)  {
                console.log(err, xhr)
            }
        })
    }

    function withdrawMoney(e, url) {
        e.preventDefault();
        const key = $('#key').val();
        $.ajax({
            method : 'POST',
            url : url,
            data : {key : key},
            success : function(res) {
                console.log(res)
                if(res.success) {
                    triggerButton(res.message, "success");
                } else {
                    triggerButton(res.message, "error");
                }
            }, 
            error : function(err, xhr)  {
                console.log(err, xhr)
            }
        })
    }
    function triggerButton(message, icon) {
        Swal.fire({
            title: message,
            icon: icon,
        })
    }
</script>
</body>
</html>

