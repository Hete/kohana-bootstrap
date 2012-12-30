<?php

/**
 * Tests for Bootstrap helper
 * 
 * @package Bootstrap
 * @category Test
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 * @copyright (c) 2012, Hète.ca Inc.
 */
class Bootstrap_Test extends Unittest_TestCase {

    public function test_alert() {
        echo Bootstrap::alert("test", "", array());
    }

    public function test_badge() {
        echo Bootstrap::badge("test", "", array());
    }

    public function test_breadcrumb() {
        echo Bootstrap::breadcrumb("test", "", array());
    }

    public function test_button() {
        echo Bootstrap::button("test", "", array());
    }

    public function test_carousel() {
        echo Bootstrap::carousel("test", "", array());
    }

    public function test_close() {
        echo Bootstrap::close("test", "", array());
    }

    public function test_dropdown_button() {
        echo Bootstrap::dropdown_button("test", "", array());
    }

    public function test_dropdown() {
        echo Bootstrap::dropdown("test", "", array());
    }

    public function test_list_item() {
        echo Bootstrap::list_item("test", "", array());
    }

    public function test_label() {
        echo Bootstrap::label("test", "", array());
    }

    public function test_modal() {
        echo Bootstrap::modal("test", "", array());
    }

    public function test_navs() {
        echo Bootstrap::navs(array("test"), "", array());
    }

    public function test_nav_list() {
        echo Bootstrap::nav_list(array("test"), "", array());
    }

    public function test_nav_pills() {
        echo Bootstrap::nav_pills(array("test"), "", array());
    }

    public function test_nav_tabs() {
        echo Bootstrap::nav_tabs(array("test"), "", array());
    }

    public function test_pagination() {
        echo Bootstrap::pagination(array("test"), "", array());
    }

    public function test_progress() {
        echo Bootstrap::progress("test", "", array());
    }

    public function test_split_button() {
        echo Bootstrap::split_button("test", "", array());
    }

}

?>
