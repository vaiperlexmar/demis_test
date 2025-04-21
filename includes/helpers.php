<?php

function createNewsCard($item, $link = "#")
{
    ob_start(); ?>
    <a class="link link_black" href="<?= $link ?>">
        <div class="news__container">
            <div class="news__body">
                <h3 class="news__title">
                    <?= $item['title']; ?>
                </h3>
                <p class="news__text">
                    <?= $item['text']; ?>
                </p>
                <span class="news__date"><?= $item['created_at'] ?></span>
            </div>
        </div>
    </a>
    <?php
    return ob_get_clean();
}