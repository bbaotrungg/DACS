<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="blog.php">
            <b style="color:red">IT</b>oxin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">&emsp;Home&emsp;</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.php">Blog&emsp;</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="category.php">Category&emsp;</a>
                </li>

                <?php
                if ($logged) {
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            href="profile.php"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa fa-user"
                                aria-hidden="true"></i> @<?= $_SESSION['username'] ?>

                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="logout.php">Logout <i class="fa fa-sign-out"></i></a></li>
                        </ul>
                    </li>

                <?php } else {
                ?>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fa fa-500px"></i> Login</a>
                    </li>
                <?php }
                ?>
            </ul>
            <form class="d-flex"
                role="search"
                method="GET"
                action="blog.php">
                <input class="form-control me-2"
                    type="search"
                    name="search"
                    placeholder="Search"
                    aria-label="Search"
                    style="width: 20em">
                <button class="btn btn-outline-success"
                    type="submit"><i class="fa fa-search"></i></button>
            </form>
            &emsp;
            <a href="php/user-post.php"
                class="btn btn-outline-success"
                role="button">
                <b>Post blog </b><i class="fa fa-plus-circle"></i>
            </a>
        </div>
    </div>
</nav>