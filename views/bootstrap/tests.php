<?php defined('SYSPATH') or die('No direct access allowed.'); ?>

<h1>Tests for Kohana Bootstrap module</h1>

<section id="alert">
    <h2>Alert</h2>
    <?php echo Bootstrap::alert("Foo") ?>
</section>

<section id="badge">
    <h2>Badge</h2>
    <?php echo Bootstrap::badge("Foo") ?>
</section>

<section id="breadcrumb">
    <h2>Breadcrumb</h2>
    <?php echo Bootstrap::breadcrumb(array("Foo", "Bar")) ?>
</section>

<section id="button">
    <h2>Button</h2>
    <?php echo Bootstrap::button("Foo") ?>
</section>

<section id="carousel">
    <h2>Carousel</h2>
    <?php echo Bootstrap::carousel("Foo", array("plenty of", "foos", "everywhere")) ?>
</section>

<section id="close">
    <h2>Close</h2>
    <?php echo Bootstrap::close() ?>
</section>

<section id="dropdown">
    <h2>Dropdown</h2>
    <?php echo Bootstrap::dropdown(array("Foo")) ?>
</section>

<section id="dropdown_button">
    <h2>Dropdown button</h2>
    <?php echo Bootstrap::dropdown_button("Foo", array("foo")) ?>
</section>

<section id="label">
    <h2>Label</h2>
    <?php echo Bootstrap::label("Foo") ?>
</section>

<section id="media">
    <h2>Media</h2>
    <?php echo Bootstrap::media("#", HTML::image("lol", array("class" => "media-object")), "sure!") ?>
</section>

<section id="modal">
    <h2>Modal</h2>
    <?php echo Bootstrap::modal("Foo", "Beautiful bar") ?>
</section>

<section id="navs">
    <h2>Navigation</h2>
    <?php echo Bootstrap::navs(array("Foo", "bar")) ?>
</section>

<section id="nav_list">
    <h2>Navigation list</h2>
    <?php echo Bootstrap::nav_list(array("#nav_list" => "Foo", "#nav_list" => "bar")) ?>
</section>

<section id="nav_pills">
    <h2>Navigation pills</h2>
    <?php echo Bootstrap::nav_pills(array("Foo", "bar")) ?>
</section>

<section id="nav_tabs">
    <h2>Navigation tabs</h2>
    <?php echo Bootstrap::nav_tabs(array("Foo", "bar")) ?>
</section>

<section id="pagination">
    <h2>Pagination</h2>
    <?php echo Bootstrap::pagination(array("Foo", "bar")) ?>
</section>

<section id="progress">
    <h2>Progress</h2>
    <?php echo Bootstrap::progress(33) ?>
</section>

<section id="split_button">
    <h2>Split button</h2>
    <?php echo Bootstrap::split_button(array("Foo", "bar", "is")) ?>
</section>

<section id="well">
    <h2>Well</h2>
    <?php echo Bootstrap::well("LOL", "small") ?>
</section>




