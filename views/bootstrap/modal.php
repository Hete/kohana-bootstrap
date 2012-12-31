<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div <?php echo HTML::attributes($attributes) ?>>
    <div class="modal-header">
        <?php echo Bootstrap::close(array("data-dismiss" => "modal", "aria-hidden" => "true")) ?>
        <h3><?php echo $title ?></h3>
    </div>
    <div class="modal-body">
        <?php echo $description ?>
    </div>
    <div class="modal-footer">
        <?php echo $close ?>
        <?php echo $save ?>
    </div>
</div>
