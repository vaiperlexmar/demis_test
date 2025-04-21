<?php

require_once __DIR__ . '/includes/db/db.php';

$DB = new \DB\db\DB();

$news = $DB->select("SELECT * FROM news ORDER BY created_at DESC");
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Новости | Demis_Test</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back"/>

</head>
<header class="header">
    <a class="link" href="/index.php">
        <span class="material-symbols-outlined link__arrow">
            arrow_back
        </span>
        <span>На главную</span>
    </a>

</header>
<main>
    <?php
    foreach ($news as $item): ?>
        <a class="link link_black" href="#">
            <div class="news__container">
                <div class="news__body">
                    <h3 class="news__title">
                        <?php
                        echo $item['title']; ?>
                    </h3>
                    <p class="news__text">
                        <?php
                        echo $item['text']; ?>
                    </p>
                    <span class="news__date"><?php
                        echo $item['created_at'] ?></span>
                </div>
            </div>
        </a>
    <?php
    endforeach; ?>
</main>


</html>