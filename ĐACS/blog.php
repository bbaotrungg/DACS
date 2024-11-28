<?php
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
}
$notFound = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (isset($_GET['search'])) {
            echo "Search for '" . htmlspecialchars($_GET['search']) . "'";
        } else {
            echo "Blog Page";
        }
        ?>
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'inc/NavBar.php';
    include_once("admin/data/Post.php");
    include_once("admin/data/Comment.php");
    include_once("db_conn.php");
    if (isset($_GET['search'])) {
        $key = $_GET['search'];
        $posts = search($conn, $key);
        if ($posts == 0) {
            $notFound = 1;
        }
    } else {
        $posts = getAll($conn);
    }
    $categories = get5Categories($conn);
    ?>

    <div class="container mt-5">
        <section class="d-flex">
            <?php if ($posts != 0) {
            ?>
                <main class="main-blog">
                    <h1 class="display-4 mb-4 fs-3">
                        <?php
                        if (isset($_GET['search'])) {
                            echo "Search for '<b>" . htmlspecialchars($_GET['search']) . "</b>'";
                        } else {
                            echo "Blog Page";
                        }
                        ?>
                    </h1>
                    <?php foreach ($posts as $post) {
                    ?>
                        <div class="card main-blog-card mb-5">
                            <img src="upload/blog/<?= $post['cover_url'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $post['post_title'] ?></h5>
                                <?php
                                $p = strip_tags($post['post_text']);
                                $p = substr($p, 0, 200);
                                ?>
                                <p class="card-text"><?= $p ?>...</p>
                                <a href="blog-view.php?post_id=<?= $post['post_id'] ?>" class="btn btn-primary">Read</a>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div class="react-btns">
                                        <?php
                                        $post_id = $post['post_id'];
                                        if ($logged) {
                                            $liked = isLikedByUserId($conn, $post_id, $user_id);
                                            if ($liked) {
                                        ?>
                                                <i class="fa fa-thumbs-up liked like-btn"
                                                    post-id="<?= $post_id ?>"
                                                    liked="1"
                                                    aria-hidden="true"></i>
                                            <?php
                                            } else {
                                            ?>
                                                <i class="fa fa-thumbs-up like like-btn"
                                                    post-id="<?= $post_id ?>"
                                                    liked="0"
                                                    aria-hidden="true"></i>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <i class="fa fa-thumbs-up"
                                                aria-hidden="true"></i>
                                        <?php
                                        }
                                        ?>
                                        <span><?php
                                                echo likeCountByPostId($conn, $post['post_id']);
                                                ?></span> 
                                        &nbsp;
                                        <a href="blog-view.php?post_id=<?= $post['post_id'] ?>#comments">
                                            <i class="fa fa-comment" aria-hidden="true"></i>
                                            <?php
                                            echo countByPostId($conn, $post['post_id'])
                                            ?>
                                        </a>
                                    </div>
                                    <p class="card-text"><small class="text-body-secondary">Post creator: @<?= $post['author'] ?></small></p>
                                    <p class="card-text"><small class="text-body-secondary"><?= $post['created_at'] ?></small></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </main>
            <?php } else { ?>
                <main class="main-blog p-2">
                    <?php
                    if ($notFound) {
                    ?>
                        <div class="alert alert-warning">
                            No result for
                            <?php
                            echo "'<b>".htmlspecialchars($_GET['search'])."</b>'";
                            ?>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-warning">
                            No posts yet!
                        </div>
                    <?php
                    }
                    ?>
                </main>
            <?php } ?>
            <aside class="aside-main">
                <div class="list-group category-aside">

                    <a href="#"
                        class="list-group-item list-group-item-action active"
                        aria-current="true">
                        Category
                    </a>
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <a href="category.php?category_id=<?= $category['id'] ?>"
                            class="list-group-item list-group-item-action">
                            <?php echo $category['category'] ?>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </aside>
        </section>
    </div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".like-btn").click(function() {
                var post_id = $(this).attr('post-id');
                var liked = $(this).attr('liked');

                if (liked == 1) {
                    $(this).attr('liked', '0');
                    $(this).removeClass('liked');
                } else {
                    $(this).attr('liked', '1');
                    $(this).addClass('liked');
                }
                $(this).next().load("ajax/like-unlike.php", {
                    post_id: post_id
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>