<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Title </title>
</head>
<body>

<h1>
    Users
</h1>
<section>
    @foreach($users as $user)
        <li>{{ $user->name }}</li>
    @endforeach
</section>
</body>
</html>
