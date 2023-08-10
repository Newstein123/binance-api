<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.21/sweetalert2.min.css" integrity="sha512-yX1R8uWi11xPfY7HDg7rkLL/9F1jq8Hyiz8qF4DV2nedX4IVl7ruR2+h3TFceHIcT5Oq7ooKi09UZbI39B7ylw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<p> this is admin </p>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.21/sweetalert2.min.js" integrity="sha512-MljqTsJt4qzUBMBjcvKamm1Ue6QD9QVBQxMd2j/yU0Q9X8ZmOTlBFY67x9IPkP7GCbuBMrNujN2gTwA5rrsKcw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Initialize Pusher with your credentials
    const pusher = new Pusher('dae5f00dabb5f453ee70', {
        cluster: 'ap1',
    });
    const channel = pusher.subscribe('generate-keys');
    channel.bind('generate-key', function(data) {
        console.log(data)
        triggerButton(data.notification)
    });

    function triggerButton(message) {
        Swal.fire({
            title: message,
            icon: 'success',
        })
    }
</script>
</body>
</html>