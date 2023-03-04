<?php
include_once "NewsDB.class.php";
$id = $_GET["id"];
$news = new newsDB();
$news_array = $news->showNews($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title><?= $news_array[0]["title"] ?></title>
</head>
<body>
    <div class="container d-flex flex-column">
        <a class="btn btn-primary btn-sm" href="news.php">Вернуться обратно</a>
        <div class="container-fluid d-flex justify-content-between">
            <h1 class="display-1"><?= $news_array[0]["title"] ?></h1>
            <h2 class="text-muted"><?php 
            switch ($news_array[0]["category"]) {
                case '1':
                    echo "Политика";
                    break;
                
                case "2":
                    echo "Культура";
                    break;

                case "3":
                    echo "Спорт";
                    break;
            }
            ?></h2>
        </div>
        <p class="lead"><?= $news_array[0]["description"] ?></p>
            <h4 class="text-end blockquote-footer"> Источник: <?= $news_array[0]["source"] ?></h4>
            <h5 class="text-end"> Время: <?= $news_array[0]["datetime"] ?></h5>
    </div>
</body>
</html>