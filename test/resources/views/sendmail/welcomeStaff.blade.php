<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


<style>
    .myButton {
	box-shadow:inset 0px 1px 0px 0px #f9eca0;
	background:linear-gradient(to bottom, #f0c911 5%, #f2ab1e 100%);
	background-color:#f0c911;
	border-radius:6px;
	border:1px solid #e65f44;
	display:inline-block;
	cursor:pointer;
	color:#c92200;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #ded17c;
}
.myButton:hover {
	background:linear-gradient(to bottom, #f2ab1e 5%, #f0c911 100%);
	background-color:#f2ab1e;
}
.myButton:active {
	position:relative;
	top:1px;
}
</style>
</head>
<body>
    

<h3>Hi {{ $details['username'] }}</h3>
<p>Message from Admin : </p>
<p>Your Staff account for User : {{ $details['username'] }} has been created</p>

<p>If you already registered with us you can safely login to your account using your password</p>
<p>Other wise</p>
<p>Please click the button below to set your account password and get access to your account :</p>

<a href="{{ URL::to('auth/passwordset/'. $details['token']) }}" class="myButton">Set Password</a>


<p>
    Best regards, <br><br>
    <strong>{{config('app.signature')}}</strong><br/>
    {{ config('app.signature-title')}}
</p>

<p>If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser</p>
<p><a href="{{ URL::to('auth/passwordset/'. $details['token']) }}">{{ URL::to('auth/passwordset/'. $details['token']) }}</a></p>
</body>
</html>