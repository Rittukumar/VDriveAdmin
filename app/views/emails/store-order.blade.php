<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="0"
       style="font-size:17px;line-height:24px;color:#373737;background:#f9f9f9">
    <tbody>
    <tr>
        <td valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <tr>
                    <td valign="bottom" style="padding:20px 16px 12px">
                        <div>
                            <a href="https://www.evezown.com" target="_blank">
                                <img src="{{ asset('http://evezown.com/img/logo.png') }}">
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
                <tbody>
                <tr>
                    <td valign="top">
                        <div style="max-width:600px;margin:0 auto;padding:0 12px">
                            <div style="background:white;border-radius:0.5rem;padding:2rem;margin-bottom:1rem">
                                <h2 style="color:#2ab27b;margin:0 0 12px;line-height:30px">Hello Store Manager</h2>

                                <p>Your have received an order!</p>

                                <p>Please find the order details:</p>

                                <p>Buyer email: {{$buyerEmail}}</p>

                                <p>Buyer phone: {{$buyerPhone}}</p>

                                <p>Transaction code: {{ $transactionCode }}</p>

                                <p>Please use the transaction code to track the order received.</p>

                                <h4>Team EvezOwn</h4>

                            </div>

                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <h1>Products</h1>

            @foreach($order['order_items'] as $orderItem)

                <div style="background: white">
                    <img src="http://52.32.201.112/public/v1/image/show/{{$orderItem['product_sku']['product_images'][0]['image']['large_image_url']}}"
                         alt="" style="width: 32px; height: auto">
                    <p>ImagePath: {{$orderItem['product_sku']['product_images'][0]['image']['large_image_url']}}</p>
                    <p>Title: {{$orderItem['product_sku']['product']['title']}}</p>
                </div>

            @endforeach
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>