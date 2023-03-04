<?php
require_once("NewsDB.class.php");
$news = new newsDB();
$errMsg = "";

if (!empty($_POST)) {
  include "save_news.inc.php";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Новостная лента</title>
	<meta charset="utf-8" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
  <div class="container-fluid">

    <h1 class="display-1">Последние новости</h1>
    <?php
    if ($errMsg !== "") {
      echo $errMsg;
    }
    ?>
    <form action="save_news.inc.php" method="post">
      Заголовок новости:<br />
      <input class="form-control" type="text" name="title" /><br />
      Выберите категорию:<br />
      <select class="form-select" name="category">
        <option value="1">Политика</option>
        <option value="2">Культура</option>
        <option value="3">Спорт</option>
      </select>
      <br />
      Текст новости:<br />
      <textarea class="form-control" name="description" cols="50" rows="5"></textarea><br />
      Источник:<br />
      <input class="form-control" type="text" name="source" /><br />
      <br />
      <input class="btn btn-primary mb-4" type="submit" value="Добавить!" />
  </form>
  </div>
<?php
$news_array = [];
require_once "get_news.inc.php";
?>
</body>
</html>