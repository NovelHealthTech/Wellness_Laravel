<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
csdcdscds


@php
    $data=session("data");
@endphp



   <script src="https://mercury.phonepe.com/web/bundle/checkout.js"></script> 

   <script>
     let data = {!! json_encode($data) !!};
     console.log(data);
    window.PhonePeCheckout.transact({ tokenUrl: data.response["redirectUrl"], callback, type: "IFRAME" });
   function callback (response) {
  if (response === 'USER_CANCEL') {
    /* Add merchant's logic if they have any custom thing to trigger on UI after the transaction is cancelled by the user*/
    return;
  } else if (response === 'CONCLUDED') {
    /* Add merchant's logic if they have any custom thing to trigger on UI after the transaction is in terminal state*/
    return;
  }
}
   </script>
    
</body>
</html>