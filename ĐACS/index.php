<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'inc/NavBar.php';
    ?>

    <div class="main-banner bg-light text-center d-flex align-items-center justify-content-center">
        <div class="container text-white">
            <h1 class="display-4 fw-bold">Welcome to <b style="color:red">IT</b>oxin<?php if ($logged) echo ", " . htmlspecialchars($_SESSION['username']); ?>!</h1><br>
            <p class="lead" style="color: #000">Discover new and interesting content about the world of information technology with<br> other users who share the same interests, so what are you waiting for, start a blog!</p>
            <div class="mt-4">
                <?php if ($logged): ?>
                    <a href="blog.php" class="btn btn-primary btn-lg me-2">Blog now!</a>
                <?php else: ?>
                    <a href="blog.php" class="btn btn-primary btn-lg me-2">Explore now!</a>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>