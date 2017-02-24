<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Certificate Expiry Alert | Certivel </title>
</head>
<body>
  Hello, {{ $user->name }}. <br>
  Your certificate {{ $certificate->fqdn }} will be expired in {{ $certificate->daysleft }} days.
</body>
</html>
