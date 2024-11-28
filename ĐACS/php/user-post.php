<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Posts Create</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="../css/richtext.min.css">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery.richtext.min.js"></script>

    </head>

    <body>
        <?php
        $key = "randomthing";
        include_once("../admin/data/Category.php");
        include_once("../db_conn.php");
        $categories = getAll($conn);
        ?>

        <div class="main-table">
            <?php if (isset($_GET['error'])) {
            ?>
                <div class="alert alert-warning">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php }
            ?>
            <?php if (isset($_GET['success'])) {
            ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_GET['success']) ?>!
                </div>
            <?php }
            ?>


            <div class="d-flex justify-content-center align-items-center">
                <div style="margin-left: -50px;">
                    <a href="../blog.php"
                        class="btn btn-primary"
                        role="button">
                        <b>Return</b>
                    </a>
                </div>
                <form class="shadow p-4 bg-white rounded"
                    action="user-post-create.php"
                    method="post"
                    enctype="multipart/form-data"
                    style="width: 100%; max-width: 1200px;">

                    <h3 class="text-center mb-4"><b>Create a Post</b></h3>

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter your title">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thumbnail</label>
                        <input type="file" class="form-control" name="cover">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea class="form-control text" name="text" rows="5" placeholder="Write your content here"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-control">
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?= $category['id'] ?>"><?= $category['category'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create</button>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('.text').richText();
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

    </html>

<?php } else {
    $em = "You need to login first!";
    header("Location: ../login.php?error=$em");
    exit;
} ?>