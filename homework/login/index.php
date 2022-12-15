<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>

<body>
    <div class="container">
        <h3 class="my-2">Log in</h3>
        <form class="form-inline" action="info.php" method="post">
            <label for="login" class="m-2">Login:</label> <input type="text" name="login" class="form-control my-2" id="login" placeholder="Enter login">
            <input type="submit" value="OK" name="submit" class="btn btn-secondary m-2">
        </form>
        <span id="massage"></span>
    </div>
</body>

</html>