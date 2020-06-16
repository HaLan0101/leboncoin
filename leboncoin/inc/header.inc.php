<?php
  $pdo = new PDO("mysql:host=localhost;dbname=leboncoin", "root", "" , array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <header>
        <div class="logo">
            <a href="index.php"><h1>StreetLamp</h1></a>
        </div>

        <div class="middle_header">
            <a href="add_article.php">
                <button type="submit">Add article</button>
              </a>
        </div>

        <div class="right_header">
            <a href="login.php"><li class="fa fa-user"></li></a>
            <a href="mes_annonces.php"><li class="fa fa-bell"></li></a>
            <a href=""><li class="fa fa-comment"></li></a>    
        </div>
    </header>
    <main>
        