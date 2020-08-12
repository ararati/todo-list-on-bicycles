<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>To-do</title>

    <link rel="stylesheet" href="/resources/css/bootstrap.min.css">

    <link rel="stylesheet" href="/resources/css/global.css">
</head>
<body>
<div class="app">
    <div class="container bg-light text-center text-muted my-4" style="max-width: 700px">
        <span class="display-1" style = "font-weight: bold;"><a href="/" class="text-success">To-Do</a></span>
        <br>
        <?php if (!isAuth()) { ?>
            <a href="/auth" class="btn btn-outline-success btn-sm">Log in</a>
        <?php } else { ?>
            <?php include('../app/views/auth/logout-form.php'); ?>
        <?php } ?>
    </div>
    <div class="container">
        <?php include $childView; ?>
    </div>
</div>

</body>