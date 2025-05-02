<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Message</title>
</head>
<body>
<h2>New message from {{ $details['name'] }}</h2>
<p><strong>Email:</strong> {{ $details['email'] }}</p>
<p><strong>Subject:</strong> {{ $details['subject'] }}</p>
<p><strong>Message:</strong></p>
<p>{{ $details['message'] }}</p>
</body>
</html>
