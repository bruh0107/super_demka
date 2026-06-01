<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Carousel;

$this->title = 'Корочки.есть';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4 caveat-text">Корочки.есть!</h1>

        <p class="lead">Записывайтесь на курсы, и получайте знания</p>
    </div>

    <div class="body-content d-flex justify-content-center">
        <?=
            Carousel::widget([
                'items' => [
                    '<img class="w-100 object-fit-cover" style="aspect-ratio: 16/9" src="/web/images/slide1.webp" alt="slide1">',
                    '<img class="w-100 object-fit-cover" style="aspect-ratio: 16/9" src="/web/images/slide2.png" alt="slide2">',
                    '<img class="w-100 object-fit-cover" style="aspect-ratio: 16/9" src="/web/images/slide3.png" alt="slide3">',
                    '<img class="w-100 object-fit-cover" style="aspect-ratio: 16/9" src="/web/images/slide4.png" alt="slide4">',
                ],
                'options' => [
                    'class' => 'w-75',
                    'data-bs-ride' => 'carousel',
                    'data-bs-interval' => '3000',
                ]
            ])
        ?>
    </div>
</div>
