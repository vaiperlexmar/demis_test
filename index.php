<?php

require_once __DIR__ . '/includes/db/db.php';
require_once __DIR__ . '/includes/functions.php';

$DB = new \DB\db\DB();

$news = $DB->select("SELECT * FROM news ORDER BY created_at DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Главная | Demis_Test</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<header class="header">
    <a class="link link_bold" href="index.php">
        <span>Главная</span>
    </a>
</header>
<main>
    <section class="section news">
        <h2 class="heading_secondary">Новости</h2>
        <?php
        foreach ($news as $news_item) {
            echo createNewsCard($news_item);
        }
        ?>

        <a class="link link_red-block link_bold" href="news.php">
            Все новости
        </a>
    </section>
    <section class="section feedback">
        <h2 class="heading_secondary">Оставить обратную связь</h2>
        <a class="link link_red-block link_bold" href="feedback_form.html">Обратная связь</a>
    </section>
</main>
</html>