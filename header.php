<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><strong>黑皮Blog</strong></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <form class="form my-2 my-lg-0" action="search.php" method="POST">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
  </form>

  <?php 
  
  function which_active($link)
  {
    if ($link == ltrim($_SERVER['PHP_SELF'], "/")) {
      return "active";
    }
  }
 
  ?>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

    <?php if (isset($_SESSION['username'])): ?>

    <ul class="navbar-nav">
      <li class="nav-item <?=which_active('index.php') ?>">
        <a class="nav-link" href="index.php">首页</a>
      </li>
      <li class="nav-item">
        <span class="navbar-text"><?=$_SESSION['username']; ?></span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">注销</a>
      </li>
    </ul>

    <?php else: ?>

    <ul class="navbar-nav">
      <li class="nav-item <?=which_active('index.php') ?>">
        <a class="nav-link" href="index.php">首页</a>
      </li>
      <li class="nav-item <?=which_active('reg.php') ?>">
        <a class="nav-link" href="reg.php">注册</a>
      </li>
      <li class="nav-item <?=which_active('login.php') ?>">
        <a class="nav-link" href="login.php">登录</a>
      </li>
    </ul>
    
    <?php endif; ?>

  </div>
</nav>