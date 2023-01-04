<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Login</title>


<body>
    <div class="pt-5">
        <form action="/login" method="POST">
            @csrf
            <div>
                <input type="text" placeholder="email" id="email" name="email">
            </div>

            <div>
                <input type="password" placeholder="password" id="password" name="password">
            </div>
            <div class="pt-2">
                <input type="submit">
            </div>

        </form>
    </div>

</body>

</html>