<html>
<head>
    <title>님의  일 이내에 만료되는 Certificate</title>
</head>
<body>
Hi, {{ $user->name }}.
Your certificate {{ $certificate->fqdn }} will be expired in {{ $certificate->daysleft }} days.
</body>
</html>
