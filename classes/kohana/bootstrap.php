<?php

/**
 * Helper class for Bootstrap.
 * 
 * @see http://twitter.github.com/bootstrap/
 * 
 * @package Bootstrap
 * @category Helpers
 * @author Hète.ca Team
 * @copyright (c) 2012, Hète.ca
 */
class Kohana_Bootstrap {

    public static function add_class(array $attributes, $class) {
        $attributes["class"] = Arr::get($attributes, "class", "") . " " . $class;
        return $attributes;
    }

    /**
     * 
     * @see 
     * 
     * @param string $message
     * @param string $type
     * @param array $attributes
     * @return string
     */
    public static function alert($message, $type = "error", array $attributes = array()) {

        $attributes = static::add_class($attributes, "alert alert-$type");

        return "<div " . HTML::attributes($attributes) . ">" . $message . "</div>";
    }

    /**
     * 
     * @param type $message
     * @param type $type
     * @return type
     */
    public static function badge($message, $type = "", $attributes = array()) {

        $attributes = static::add_class($attributes, "badge badge-$type");

        return "<span class='badge badge-$type'>" . $message . "</span>";
    }

    /**
     * Generate a Bootstrap breadcrumb.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#breadcrumbs
     * 
     * @param array $links where keys are urls and values are texts to show.
     * @param string $divider is the divider used to split the $links elements.
     * @return string
     */
    public static function breadcrumb(array $elements, array $attributes = array(), $divider = "/") {

        $attributes = static::add_class($attributes, "breadcrumb");

        $output = "<ul " . HTML::attributes($attributes) . ">";

        $count = 0;

        foreach ($elements as $key => $value) {
            $count++;
            $output .= "<li>" . HTML::anchor($value, $key);
            if ($count < count($elements)) {
                $output .= "<span class='divider'>$divider</span>";
            }
            $output .= "</li>";
        }

        $output .= "</ul>";

        return $output;
    }

    /**
     * Generate a Bootstrap button.
     * @param type $text Text to show
     * @param type $type Button type
     * @param type $name Form name
     * @param type $value Form value
     * @param array $attributes Extra attributes
     * @return string
     */
    public static function button($text, $type = "", $name = NULL, $value = NULL, array $attributes = array()) {

        $attributes = static::add_class($attributes, "btn btn-$type");
        $attributes["name"] = $name;
        $attributes["value"] = $value;

        return "<button " . HTML::attributes($attributes) . ">" . $text . "</button>";
    }

    public static function carousel(array $elements, $actives = NULL, array $attributes = array()) {

        if ($actives === NULL) {
            $actives = array();
        }

        if (!Arr::is_array($actives)) {
            $actives = array($actives);
        }

        $attributes = static::add_class($attributes, "carousel slide");
        return View::factory("bootstrap/carousel", array("elements" => $elements, "actives" => $actives, "attributes" => $attributes));
    }

    /**
     * Generates a Bootstrap close button.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#misc
     * 
     * @param type $text
     * @param array $attributes
     * @return type
     */
    public static function close($text = "&times;", array $attributes = array()) {

        $attributes = static::add_class($attributes, "close");

        $attributes["href"] = "#";

        return HTML::anchor($text, $attributes);
    }

    /**
     * 
     * @see http://twitter.github.com/bootstrap/components.html#buttonDropdowns
     * 
     * @param type $title title for the dropdown button.
     * @param array $elements elements to include in the dropdown button
     * @param array $type 
     * @param array $attributes custom attributes for the button group.
     * @return type String renders the HTML Code to create the button
     */
    public static function dropdown_button($title, array $elements, $type = "", array $attributes = array()) {

        if (count($elements) === 1) {
            return static::button($elements[0], $type);
        }

        // Ajout des classes de base
        $attributes["class"] = Arr::get($attributes, "class", "") . " btn-group";

        $output = "<div " . HTML::attributes($attributes) . ">";

        $output .= static::button("$title<span class = 'caret'></span>", NULL, NULL, array("dropdown-toggle", "data-toggle" => "dropdown"));

        $output .= static::dropdown($elements);

        $output .= "</div>";

        return $output;
    }

    /**
     * Generates a basic dropdown menu.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#dropdowns
     * 
     * @param array $elements elements to include in the dropdown.
     * @param array $attributes attributes for the dropdown
     * @return string
     */
    public static function dropdown(array $elements, $actives = NULL, array $attributes = array()) {

        if ($actives === NULL) {
            $actives = array();
        }

        if (!Arr::is_array($actives)) {
            $actives = array($actives);
        }

        $attributes = static::add_class($attributes, "dropdown-menu");

        $output = "<ul " . HTML::attributes($attributes) . ">";

        foreach ($elements as $key => $element) {
            $atts = array("class" => (in_array($key, $actives) ? "active" : ""));

            if (Arr::is_array($element)) {
                // Creating submenu
                $atts = static::add_class($atts, "dropdown-submenu");
                $output .= "<li " . HTML::attributes($atts) . ">" . static::dropdown($elements, $attributes) . "></li>";
            } else {
                $output .= "<li " . HTML::attributes($atts) . ">" . static::list_item($key, $element) . "</li>";
            }
        }

        $output .= "<ul></div>";

        return $output;
    }

    public static function list_item($key, $value) {
        if (is_numeric($key)) {
            return $value;
        } else {
            return HTML::anchor($key, $value);
        }
    }

    public static function label($message, $type = "", array $attributes = array()) {

        $attributes = static::add_class($attributes, "label label-$type");

        return "<span " . HTML::attributes($attributes) . ">" . $message . "</span>";
    }

    /**
     * 
     * @see http://twitter.github.com/bootstrap/javascript.html#modals
     * 
     * @param type $title
     * @param type $description
     * @param type $save save button
     * @param type $cancel cancel button
     * @param array $variables replacement variables for translation.
     * @param array $attributes attributs du modal.
     * @param array $parameters view parameters.
     * 
     * @return string
     */
    public static function modal($title, $description, $save = NULL, $close = NULL, array $attributes = array()) {

        $attributes = static::add_class($attributes, "modal hide fade");

        $parameters["title"] = $title;
        $parameters["description"] = $description;
        $parameters["save"] = $save;
        $parameters["close"] = $close;
        $parameters["attributes"] = $attributes;

        return View::factory("bootstrap/modal", $parameters);
    }

    /**
     * 
     * @see http://twitter.github.com/bootstrap/components.html#navs
     * 
     * @param array $links
     * @param type $actives
     * @param type $attributes
     * @return string
     */
    public static function navs(array $links, $actives = NULL, $attributes = array()) {
        $attributes = static::add_class($attributes, "nav");

        if ($actives === NULL) {
            $actives = array();
        }

        if (!Arr::is_array($actives)) {
            $actives = array($actives);
        }

        $output = "<ul " . HTML::attributes($attributes) . ">";

        foreach ($links as $uri => $text) {
            $output .= "<li " . HTML::attributes(array("class" => in_array($uri, $actives) ? "active" : "")) . " >";
            $output .= static::list_item($uri, $text);
            $output .= "</li>";
        }

        $output .= "</ul>";

        return $output;
    }

    /**
     * 
     * @param array $links array of uri => name 
     * @param array|string $actives active tabs
     * @param array $attributes
     * @return type
     */
    public static function nav_list(array $links, $actives = NULL, $attributes = array()) {

        $attributes = static::add_class($attributes, "nav-list");

        return static::navs($links, $actives, $attributes);
    }

    /**
     * 
     * @param array $links array of uri => name 
     * @param array|string $actives active tabs
     * @param array $attributes
     * @return type
     */
    public static function nav_pills(array $links, $actives = NULL, $attributes = array()) {

        $attributes = static::add_class($attributes, "nav-pills");

        return static::navs($links, $actives, $attributes);
    }

    /**
     * 
     * @param array $links array of uri => name 
     * @param array|string $actives active tabs
     * @param array $attributes
     * @return type
     */
    public static function nav_tabs(array $links, $actives = NULL, $attributes = array()) {

        $attributes = static::add_class($attributes, "nav-tabs");

        return static::navs($links, $actives, $attributes);
    }

    /**
     * Generate a bootstrap pagination given links.
     * @param array $links
     * @param array|string $active can be an active key from $links or an array of active
     * keys.
     * @param array $attributes attributs css appliqué au div.
     * @return string
     */
    public static function pagination(array $links, $actives = NULL, array $attributes = array()) {

        if ($actives === NULL) {
            $actives = array();
        }

        if (!Arr::is_array($actives)) {
            $actives = array($actives);
        }

        $attributes = static::add_class($attributes, "pagination");

        $output = "<div " . HTML::attributes($attributes) . "><ul>";

        foreach ($links as $key => $value) {
            $output .= "<li " . HTML::attributes(array("class" => (in_array($key, $actives) ? "active" : ""))) . ">";
            $output .= static::list_item($key, $value);
            $output .= "</li>";
        }

        $output .= "</ul></div>";

        return $output;
    }

    /**
     * Generates a Bootstrap progress bar.
     * @param type $message
     * @param type $type
     * @return type
     */
    public static function progress($progress, $type = "", array $attributes = array()) {

        $attributes = static::add_class($attributes, "progress progress-$type");

        $output = "<div " . HTML::attributes($attributes) . ">";

        // Support for multiple progress bars
        if (Arr::is_array($progress)) {
            foreach ($progress as $p) {
                $output .= "<div class='bar' style='width:$p%' />";
            }
        }

        $output .= "</div>";

        return $output;
    }

    /**
     * Créé un split button.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#buttonSplitbutton
     * 
     * @param array $elements liste des éléments à disposer dans le split button.
     * @param string $type
     * @return string
     */
    public static function split_button(array $elements, $type = "", array $attributes = array()) {

        if (count($elements) === 1) {
            return static::button($elements[0], $type);
        }

        $attributes["class"] = Arr::get($attributes, "class", "") . " btn-group";

        $output = "<div " . HTML::attributes($attributes) . ">";

        $output .= static::button(array_shift($elements), $type);

        // Dropdown button in this case has no title, just a caret
        $output .= static::dropdown_button("", $elements);

        $output .= "</div>";

        return $output;
    }

}

?>
