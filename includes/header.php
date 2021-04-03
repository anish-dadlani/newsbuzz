<style>
.logo {
    color: #ffffff !important;
    font-size: 24px;
    text-transform: uppercase;
    font-family: 'Hind Madurai', sans-serif;
    font-weight: 600;
    letter-spacing: 1px;
    line-height: 40px;
}

a {
    color: #337ab7;
    text-decoration: none;
}
</style>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <div class="topbar-left">
            <a href="index.php" class="logo"><span>NEWS<span>BUZZ</span></span><i class="mdi mdi-layers"></i></a>
        </div>
        <!-- <a class="navbar-brand" href="index.php"><img src="images/logo.png" height="50"></a> -->
        <!-- <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">News</a>
                </li>
                <?php if(isset($_SESSION['login'])){?>
                    <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"><?php echo $_SESSION['login']; ?></a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php }else{?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login/Signup</a>
                    </li>
                <?php }?>
                <li class="nav-item">
                    <a class="nav-link" href="search_crawler.php">Search Other NEWS-Sites</a>
                </li>
            </ul>
        </div>
    </div>
</nav>