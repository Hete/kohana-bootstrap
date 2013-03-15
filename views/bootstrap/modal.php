<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<div <?php echo HTML::attributes($attributes) ?>>
    <?php echo Form::open($action, array("style" => "margin-bottom: 0px;")) ?>
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
    <?php echo Form::close() ?>
</div>
