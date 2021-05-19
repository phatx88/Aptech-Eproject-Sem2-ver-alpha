<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bigdeal - Multi-purpopse E-commerce Html Template</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="big-deal">
    <meta name="keywords" content="big-deal">
    <meta name="author" content="big-deal">
    <link rel="icon" href="../assets/images/favicon/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon/favicon.png" type="image/x-icon">

    <!--Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

    <!--page css-->
    <style type="text/css">
        body{
            text-align: center;
            margin: 0 auto;
            width: 650px;
            font-family: 'Open Sans', sans-serif;
            background-color: #e2e2e2;
            display: block;
        }
        ul{
            margin:0;
            padding: 0;
        }
        li{
            display: inline-block;
            text-decoration: unset;
        }
        a{
            text-decoration: none;
        }
        p{
            margin: 15px 0;
        }

        h5{
            color:#444;
            text-align:center;
            font-weight:400;
        }

        .text-center{
            text-align: center
        }
        .main-b-g-light{
            background-color: #fafafa;
        }
        .title{
            color: #444444;
            font-size: 22px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 10px;
            padding-bottom: 0;
            text-transform: uppercase;
            display: inline-block;
            line-height: 1;
        }
        table{
            margin-top:30px
        }
        table.top-0{
            margin-top:0;
        }
        table.order-detail {
            border: 1px solid #ddd;
            border-collapse: collapse;
        }
        table.order-detail tr:nth-child(even) {
            border-top:1px solid #ddd;
            border-bottom:1px solid #ddd;
        }
        table.order-detail tr:nth-child(odd) {
            border-bottom:1px solid #ddd;
        }
        .pad-left-right-space{
            border: unset !important;
        }
        .pad-left-right-space td{
            padding: 5px 95px;
        }
        .pad-left-right-space td p{
            margin: 0;
        }
        .pad-left-right-space td b{
            font-size:15px;
            font-family: 'Roboto', sans-serif;
        }
        .order-detail th{
            font-size:16px;
            padding:15px;
            text-align:center;
            background: #fafafa;
        }
        .footer-social-icon tr td img{
            margin-left:5px;
            margin-right:5px;
        }
        .dancing-script{
            font-family: 'Dancing Script', cursive;
        }
    </style>
</head>
<body style="margin: 20px auto;">
<table align="center" border="0" cellpadding="0" cellspacing="0" style="padding: 0 30px;background-color: #f8f9fa; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);width: 100%;">
    <tbody>
    <tr>
            @php
                $subtotal = 0;
                $shipping_fee = 0;
                $coupon_fee = 0;
            @endphp
        <td>
            @foreach($details as $key => $detail)

            <table align="left" border="0" cellpadding="0" cellspacing="0" style="text-align: left;" width="100%">
                <tr>
                    <td style="text-align: center;">
                        <img width="250px" height="250px" src="{{$message->embed(asset('frontend/images/emails/about.jpg'))}}" style="border-radius: 50%">
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <h3 style="font-size: 36px; font-weight: 600" class="dancing-script">Liquore <span style="color: red">Store</span> </h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="font-size: 18px;"><b>Hi {{ $detail['user_name'] }},</b></p>
                        @foreach($detail['order_mail'] as $key => $order)
                        <?php
                            $shipping_fee = $order->shipping_fee;

                            if($order->coupon_id != null){
                            $coupon_fee = $order->coupon->number;
                            }
                        ?>
                        <p style="font-size: 14px;">Thank you, we have received your order, please wait for confirmation!</p>
                        <p style="font-size: 14px;">Transaction ID : {{ $order->id }},</p>
                    </td>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" align="left" style="width: 100%;margin-top: 10px;    margin-bottom: 10px;">
                <tbody>

                <tr>
                    <td style="background-color: #fafafa;border: 1px solid #ddd;padding: 15px;letter-spacing: 0.3px;width: 50%;">
                        <h5 style="font-size: 16px; font-weight: 600;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px;">Your Shipping Address</h5>
                        <p style="text-align: left;font-weight: normal; font-size: 14px; color: #000000;line-height: 21px;    margin-top: 0;">
                            {{ $order->shipping_housenumber_street }} , {{ $order->ward->name }}, {{ $order->ward->district->name }} , {{ $order->ward->district->province->name }}

                        </p>
                    </td>
                    <td style="background-color: #fafafa;border: 1px solid #ddd;padding: 15px;letter-spacing: 0.3px;width: 50%;">
                        <h5 style="font-size: 16px;font-weight: 600;color: #000; line-height: 16px; padding-bottom: 13px; border-bottom: 1px solid #e6e8eb; letter-spacing: -0.65px; margin-top:0; margin-bottom: 13px;">Payment method</h5>
                        <p style="text-align: center;font-weight: normal; font-size: 14px; color: #000000;line-height: 21px;    margin-top: 0;">
                            @if ($order->payment_method == 0)
                                COD
                            @else 
                                Bank Transfer - VietComBank 12330123031   
                            @endif
                        </p>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            <table class="order-detail" border="0" cellpadding="0" cellspacing="0"  align="left" style="width: 100%;    margin-bottom: 50px;">
                <tr class="pad-left-right-space " align="left">
                    <th>Product Name</th>
                    <th>Featured Image</th>
                    {{-- <th>Description</th> --}}
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
                @foreach($detail['order_details'] as $key => $or_details)
                <tr class="pad-left-right-space " style="text-align: center">
                    <td valign="top">
                        <h5 style="margin-top: 15px; font-size: 1.2em; font-weight: 600">{{ substr($or_details->product->name, 0 , strpos($or_details->product->name, ' ' , 15)) }}</h5>
                    </td>
                    <td valign="top">
                        <img width="100px" height="100px" src="{{$message->embed(asset('frontend/images/products/'.$or_details->product->featured_image))}}">
                    </td>
                    {{-- <td valign="top" style="padding-left: 15px;">
                        <h5 style="margin-top: 15px;">{{ substr($or_details->product->description , 30) }}</h5>
                    </td> --}}
                    <td valign="top">

                        <h5 style="font-size: 14px; color:#444;margin-top: 10px;">QTY :
                            <span>
                                {{ $or_details->qty }}
                            </span></h5>
                    </td>
                    <td valign="top">
                        <h5 style="font-size: 14px; color:#444;margin-top:15px"><b>${{ $or_details->total_price }}</b></h5>
                    </td>
                </tr>
                @php $subtotal += $or_details->total_price; @endphp
                @endforeach

                <tr class="pad-left-right-space ">
                    <td class="m-t-5" colspan="2" align="left">
                        <p style="font-size: 14px;">Subtotal : </p>
                    </td>
                    <td class="m-t-5" colspan="2" align="right">
                        <b style>${{ $subtotal }}</b>
                    </td>
            
                <tr class="pad-left-right-space">
                    <td colspan="2" align="left">
                        <p style="font-size: 14px;">SHIPPING Charge :</p>
                    </td>
                    <td colspan="2" align="right">
                        <b>${{ $shipping_fee }}</b>
                    </td>
                </tr>
                @if($coupon_fee != 0)
                <tr class="pad-left-right-space">
                    <td colspan="2" align="left">
                        <p style="font-size: 14px;">Coupon :</p>
                    </td>
                    <td colspan="2" align="right">
                        <b> ${{ $coupon_fee }}</b>
                    </td>
                </tr>
                @endif
                <tr class="pad-left-right-space ">
                    <td class="m-b-5" colspan="2" align="left">
                        <p style="font-size: 14px;">Total :</p>
                    </td>
                    <td class="m-b-5" colspan="2" align="right">
                        <b>${{ $subtotal - $coupon_fee + $shipping_fee }}</b>
                    </td>
                </tr>

            </table>
            @endforeach
        </td>
    </tr>
    </tbody>
</table>
<table class="main-b-g-light text-center top-0"  align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="padding: 30px;">
          
            <div style="border-top: 1px solid #ddd; margin: 20px auto 0;"></div>
            <table  border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 20px auto 0;" >
                <tr>
                    <td>
                        <a href="#" style="font-size:13px">Want to change how you receive these emails?</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="font-size:13px; margin:0;">2018 - 19 Copy Right by Themeforest powerd by Pixel Strap</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#" style="font-size:13px; margin:0;text-decoration: underline;">Unsubscribe</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
