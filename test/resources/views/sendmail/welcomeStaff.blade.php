<h3>Hi {{ $details['username'] }}</h3>
<p>Message from Admin : </p>
<p>Your account for email : {{ $details['username'] }} has been created</p>

<p>Please click the button below to set your account password and get access to your account :</p>

<a href="{{ URL::to('auth/passwordset/'. $details['token']) }}" class="button">Set Password</a>


<p>
    Best regards, <br><br>
    <strong>{{config('app.signature')}}</strong><br/>
    {{ config('app.signature-title')}}
</p>

<p>If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser</p>
<p><a href="{{ URL::to('auth/passwordset/'. $details['token']) }}">{{ URL::to('auth/passwordset/'. $details['token']) }}</a></p>