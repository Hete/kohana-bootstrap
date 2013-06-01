<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div<?php echo HTML::attributes($attributes) ?>>
    <!-- Carousel items -->
    <div class="carousel-inner">
        <?php foreach ($elements as $key => $element) : ?>

            <?php
            $_attributes = array('class' => 'item');

            if (in_array($key, $actives)) {
                Bootstrap::add_attribute($_attributes, 'active');
            }
            ?>

            <?php echo Bootstrap::base('div', $element, $variables, $_attributes) ?>

        <?php endforeach; ?>
    </div>
    <!-- Carousel nav -->
    <?php if ($elements): ?>
        <?php echo HTML::anchor('#' . $attributes['id'], '&lsaquo;', array('class' => 'carousel-control left', 'data-slide' => 'prev')) ?>
        <?php echo HTML::anchor('#' . $attributes['id'], '&rsaquo;', array('class' => 'carousel-control right', 'data-slide' => 'next')) ?>
    <?php endif; ?>
</div>
