<?php
include_once "news.php";

if (!$news->getNews()) {
    $errMsg = "Произошла ошибка при выводе новостной ленты";
} else { 
    $news_array = $news->getNews();
    echo "<h2> Список новостей: </h2> ";
    echo "<table class='table'>
    <thead>
        <tr>
            
            <th>Заголовок</th>
            <th>Категория</th>
            
            <th>Источник</th>
        </tr>
    </thead>
    <tbody> ";
    foreach ($news_array as $row) {

     echo "<tr>";
        
        echo '<td><a href="show-news.php?id=' . $row["id"] . '">' . $row["title"] . '</a></td>';
        echo "<td>" . $row["category"] . "</td>";
        
        echo "<td>" . $row["source"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>
</table>";
}

