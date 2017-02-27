<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Certificate Expiry Alert | Certivel </title>
</head>
<body>
Hello, {{ $user->name }}.<br>
<br>
You recieve this mail because you are a member of Certivel.<br>
This is a service which monitors an SSL certificate on a website, and notifies you when it is about to expire.<br>
This extra notification helps you remember to renew your certificate on time.<br>
<br>
We've noticed that certificate on following domain will be expired in {{ $certificate->daysleft }} days:<br>
<br>
Domain: {{ $certificate->fqdn }}<br>
<br>
Please check this website or it's certificate, and renew your certificate before it's expired.<br>
<br>
Have a nice day,<br>
<a href="{{ url('/') }}">Certivel</a>
</body>
</html>
