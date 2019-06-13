<?php 

error_reporting( E_ALL & ~E_NOTICE );

// 接管session
include("session.php");
session_start();

// 导入数据库配置
include("connect.php");

try {
  // 连接数据库
  $con = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_username, $db_password);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // 获取文章列表
  $sql = "SELECT * FROM comment INNER JOIN user ON comment.uid = user.id";
  $sth = $con->prepare($sql);
  $sth->execute();
  $sth->setFetchMode(PDO::FETCH_ASSOC); 
  $article = $sth->fetchAll();

} catch (PDOException $e) {
  die ("连接数据库失败:" . $e->getMessage(). "</br>");
} 

?>


<!doctype html>
<html lang="zh-CN">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="app.css">
    <title>黑皮Blog</title>
  </head>
  <body>
    <!-- 状态栏 -->
    <div class="container">
        <?php include('header.php'); ?>
    </div>
    <!-- 内容区域 -->
    <div class="container">

      <!-- 顶部间隔 -->
      <div class="w-100" style="height:20px"></div>

      <!-- 主内容区域 -->
      <div class="row justify-content-between">
        <!-- 左边内容区域 -->
        <div class="col-8">
          <div class="left bg-white">
            <ul class="feeds">
              <?php foreach($article as $item): ?>
              <li class="feed"> 
                <div class="media">
                  <img src="img/avatar.png" alt="头像" class="align-self-start mr-3 avatar">
                  <div class="media-body">
                    <p class="mt-0 article-title"><?=$item['title']; ?></p>
                    <p class="mb-0">
                      <span class="article-author"><strong><?=$item['username'] ?></strong></span>&nbsp&nbsp&nbsp<span class="article-create_data"><strong><?=$item['create_data']; ?></strong></span>
                    </p>      
                  </div>
                </div>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <!-- 右边内容区域 -->
        <div class="col-4">
          <div class="right bg-white">
            <?php include("rightbar-1.php"); ?>
          </div>
        </div>
      </div>

      <!-- 底部间隔 -->
      <div class="w-100" style="height:20px"></div>
    </div>

    <!-- 底部栏 -->
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="content bg-white">
            底部栏
          </div>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    <!-- <script src="main.js"></script> -->
  </body>
</html>