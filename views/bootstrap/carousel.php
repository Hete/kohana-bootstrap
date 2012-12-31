<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div <?php echo HTML::attributes($attributes) ?>>
    <!-- Carousel items -->
    <div class="carousel-inner">
        <?php foreach ($elements as $key => $element) : ?>
            <div <?php echo HTML::attributes(array("class" => "item" . (in_array($key, $actives) ? "active" : ""))); ?>>
                <?php echo $element ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#<?php echo $attributes["id"] ?>" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#<?php echo $attributes["id"] ?>" data-slide="next">&rsaquo;</a>
</div>
