<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
</head>
<body>
    @forelse ($messages as $message)
        <p>user name is {{ $message->name }}</p>
    @empty
        <p>no data</p>
    @endforelse
</form>
</body>
</html>