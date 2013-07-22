<?php

defined('SYSPATH') or die('No direct access allowed.');

/**
 * Helper class for Bootstrap.
 * 
 * This is designed as generic as possible. Inputs are safed against XSS and
 * other security breaches on Kohana layer.
 * 
 * @see http://twitter.github.com/bootstrap/
 * 
 * @package Bootstrap
 * @category Helpers
 * @author Hète.ca Team
 * @copyright (c) 2013, Hète.ca Inc.
 */
class Kohana_Bootstrap {

    const CARET = '<span class="caret"></span>',
            SUCCESS = 'success',
            INFO = 'info',
            WARNING = 'warning',
            ERROR = 'error';

    public static $types = array(
        'success',
        'info',
        'warning',
        'error'
    );

    /**
     * Append an attributes without overriding existing attributes. class is
     * used by default.
     * 
     * @param array $attributes array of key-value pairs of attributes
     * @param type $value value to append
     * @param type $name name of the attribute
     */
    public static function add_attribute(&$attributes, $value, $name = "class") {
        $attributes[$name] = Arr::get($attributes, $name, "") . " " . $value;
    }

    /**
     * Generates a Bootstrap alert.
     * 
     * @see 
     * 
     * @param string $message
     * @param string $type
     * @param array $attributes
     * @return string
     */
    public static function alert($message, $type = "", array $attributes = NULL) {

        static::add_attribute($attributes, "alert alert-$type");

        return '<div' . HTML::attributes($attributes) . '>' . $message . '</div>';
    }

    /**
     * Generates a Bootstrap badge.
     * 
     * @see 
     * 
     * @param string $message
     * @param string $type
     * @param array $attributes
     * @return string
     */
    public static function badge($message, $type = "", $attributes = NULL) {

        static::add_attribute($attributes, "badge badge-$type");

        return '<span' . HTML::attributes($attributes) . '>' . $message . '</span>';
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
    public static function breadcrumb(array $elements, $divider = "/", array $attributes = NULL) {

        static::add_attribute($attributes, "breadcrumb");

        $output = "<ul " . HTML::attributes($attributes) . ">";

        $count = 0;

        foreach ($elements as $value) {
            $count++;

            $output .= "<li>";

            $output .= $value;

            // Check if we add a divider
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
     * 
     * Basically, it makes a simple button. However, if only a string $value is
     * specified ($name being NULL), it will make an anchor button.
     * 
     * @param string $text text to show
     * @param string $name name in a form
     * @param string $value value in a form or href if $name is NULL
     * @param string $type 
     * @param array $attributes 
     * @return string
     */
    public static function button($text, $name = NULL, $value = NULL, $type = "", array $attributes = NULL) {

        static::add_attribute($attributes, "btn btn-$type");

        $attributes["name"] = $name;
        $attributes["value"] = $value;

        $tag = "button";

        if ($name === NULL && is_string($value)) {
            // It's a link button        
            return HTML::anchor($value, $text, $attributes);
        }

        return "<$tag " . HTML::attributes($attributes) . ">" . $text . "</$tag>";
    }

    /**
     * Generates a Bootstrap carousel slideshow.
     * 
     * @see
     * 
     * @param string $id is the id to identify the carousel.
     * @param array $elements are the elements shown in the carousel.
     * @param array|string $actives are the active elements.
     * @param array $attributes 
     * @return View
     */
    public static function carousel($id, array $elements, $actives = NULL, array $attributes = NULL) {

        if ($actives === NULL) {

            $actives = array();

            // Le premier élément est actif
            if (Valid::not_empty($elements)) {
                $keys = array_keys($elements);
                $actives[] = array_shift($keys);
            }
        }

        if (!Arr::is_array($actives)) {
            $actives = array($actives);
        }

        static::add_attribute($attributes, "carousel slide");

        $attributes["id"] = $id;

        return View::factory("bootstrap/carousel", array("elements" => $elements, "actives" => $actives, "attributes" => $attributes));
    }

    /**
     * Generates a Bootstrap close button.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#misc
     * 
     * @param string $text
     * @param array $attributes
     * @return type
     */
    public static function close(array $attributes = NULL) {

        static::add_attribute($attributes, "close");

        // Fix for iPhone
        $attributes["href"] = Arr::get($attributes, "href", "#");

        return static::button("&times;", NULL, NULL, "", $attributes);
    }

    /**
     * Generates a basic dropdown menu. This function supports recursivity for
     * sub-menues.
     * 
     * For sub-menues, the key will be the text shown and the value has to be
     * a valid $elements array for recursivity. There is no convenient way to
     * make clickable parent menus. (However, if you have suggestions, go on!)
     * 
     * @todo clickable menus with child
     * 
     * @see http://twitter.github.com/bootstrap/components.html#dropdowns
     * 
     * @param array $elements elements to include in the dropdown.
     * @param variant $actives actives elements.
     * @param array $attributes attributes for the dropdown.
     * @return string
     */
    public static function dropdown(array $elements, $actives = NULL, array $attributes = NULL) {

        if ($actives === NULL) {
            $actives = array();
        }

        if (!Arr::is_array($actives)) {
            $actives = array($actives);
        }

        static::add_attribute($attributes, "dropdown-menu");

        $output = "";

        $output = "<ul " . HTML::attributes($attributes) . ">";


        foreach ($elements as $key => $element) {
            $atts = array("class" => (in_array($key, $actives) ? "active" : ""));

            if (Arr::is_array($element)) {
                // Creating submenu
                static::add_attribute($atts, "dropdown-submenu");
                $output .= "<li " . HTML::attributes($atts) . ">" . $key . static::dropdown($element, NULL, $attributes, TRUE) . "</li>";
            } else {
                $output .= "<li " . HTML::attributes($atts) . ">$element</li>";
            }
        }

        $output .= "</ul>";

        return $output;
    }

    /**
     * Generates a Bootstrap dropdown button.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#buttonDropdowns
     * 
     * @param type $title title for the dropdown button.
     * @param array $elements elements to include in the dropdown button
     * @param array $type 
     * @param array $attributes custom attributes for the button group.
     * @return string rendered HTML Code to create the button
     */
    public static function dropdown_button($title, array $elements, $actives = NULL, $type = "", array $attributes = NULL, array $button_attributes = NULL, array $dropdown_attributes = NULL) {

        // With zero elements, we return nothing
        if (count($elements) === 0) {
            return "";
        }

        // If only one element is specified, we draw a simple button
        if (count($elements) === 1) {
            // First element can be a link
            $keys = array_keys($elements);
            return static::button(array_shift($elements), NULL, Arr::get($keys, 0), $type, $attributes);
        }

        static::add_attribute($attributes, "btn-group");

        $output = "<div " . HTML::attributes($attributes) . ">";

        static::add_attribute($button_attributes, "dropdown-toggle");
        $button_attributes["data-toggle"] = "dropdown";

        $output .= static::button($title . " " . static::CARET, NULL, NULL, $type, $button_attributes);

        $output .= static::dropdown($elements, $actives, $dropdown_attributes);

        $output .= "</div>";

        return $output;
    }

    /**
     * Glyphicon generator.
     * 
     * @see http://twitter.github.com/bootstrap/base-css.html#icons
     * 
     * @param string $name is the icon name without the "icon-" prefix.
     * @param array $attributes are any extra attributes to add to the i tag.
     * @return string html code for the icon.
     */
    public static function icon($name, array $attributes = NULL) {

        static::add_attribute($attributes, "icon-$name");

        return "<i " . HTML::attributes($attributes) . "></i>";
    }

    /**
     * Generates a Bootstrap label.
     * 
     * @see 
     * 
     * @param type $message
     * @param type $type
     * @param array $attributes
     * @return type
     */
    public static function label($message, $type = "", array $attributes = NULL) {

        static::add_attribute($attributes, "label label-$type");

        return "<span " . HTML::attributes($attributes) . ">" . $message . "</span>";
    }

    /**
     * Generates a Bootstrap modal.
     * 
     * @see http://twitter.github.com/bootstrap/javascript.html#modals
     * 
     * @param string $id is an unique id to identify the modal and trigger it.
     * @param type $title is the title of the modal.
     * @param type $description is the description of the modal.
     * @param string $action is the form action, if appliable.
     * @param type $save save button.
     * @param type $cancel cancel button.
     * @param array $attributes attributs du modal.     
     * @param array $parameters are the parameters passed to the view.
     * @return View
     */
    public static function modal($id, $title, $description, $action = NULL, $save = NULL, $close = NULL, array $attributes = NULL, array $parameters = NULL) {

        static::add_attribute($attributes, "modal hide fade");

        $attributes["id"] = "$id";

        $parameters["title"] = $title;
        $parameters["description"] = $description;
        $parameters["action"] = $action;
        $parameters["save"] = $save;
        $parameters["close"] = $close;
        $parameters["attributes"] = $attributes;

        return View::factory("bootstrap/modal", $parameters);
    }

    /**
     * Generates basic navs.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#navs
     * 
     * @param array $elements
     * @param variant $actives
     * @param array $attributes
     * @param array $sub_attributes attributes passed to sub navs.
     * @return string
     */
    public static function navs(array $elements, $actives = NULL, array $attributes = NULL, array $sub_attributes = NULL, array $li_attributes = NULL) {

        static::add_attribute($attributes, "nav");

        if ($actives === NULL) {
            $actives = array();
        }

        if (!Arr::is_array($actives)) {
            $actives = array($actives);
        }

        $output = "<ul " . HTML::attributes($attributes) . ">";

        foreach ($elements as $key => $element) {

            $_li_attributes = $li_attributes;

            if (in_array($key, $actives)) {
                static::add_attribute($_li_attributes, 'active');
            }

            $output .= "<li " . HTML::attributes($_li_attributes) . " >";

            if (Arr::is_array($element)) {
                $output .= static::navs($element, $actives, $sub_attributes);
            } else {
                $output .= $element;
            }

            $output .= "</li>";
        }

        $output .= "</ul>";

        return $output;
    }

    /**
     * Generates a navigation bar.
     * 
     * @see
     * 
     * @param type $brand
     * @param array $elements
     * @param type $actives
     * @param type $attributes
     * @return string
     */
    public static function navbar($brand, array $elements, $actives = NULL, array $attributes = NULL, array $nav_attributes = NULL) {

        static::add_attribute($attributes, "navbar");

        $output = "<div " . HTML::attributes($attributes) . ">";

        $output .= "<div " . HTML::attributes(array("class" => "navbar-inner")) . ">";

        if ($brand !== NULL) {
            $output .= "<div " . HTML::attributes(array("class" => "brand")) . ">" . $brand . "</div>";
        }

        $output .= static::navs($elements, $actives, $nav_attributes);

        $output .= "</div>";

        $output .= "</div>";

        return $output;
    }

    /**
     * Generates a Bootstrap navigation list.
     * 
     * @see 
     * 
     * @param array $elements array of uri => name 
     * @param array|string $actives active tabs
     * @param array $attributes
     * @return type
     */
    public static function nav_list(array $elements, $actives = NULL, array $attributes = NULL) {

        static::add_attribute($attributes, "nav-list");

        return static::navs($elements, $actives, $attributes);
    }

    /**
     * Generates Bootstrap navigation pills.
     * 
     * @see
     * 
     * @param array $elements array of uri => name 
     * @param array|string $actives active tabs
     * @param array $attributes
     * @return type
     */
    public static function nav_pills(array $elements, $actives = NULL, array $attributes = NULL, array $sub_attributes = NULL, array $li_attributes = NULL) {

        static::add_attribute($attributes, "nav-pills");

        // Subnavs are stacked
        static::add_attribute($sub_attributes, 'nav-pills nav-stacked');

        return static::navs($elements, $actives, $attributes, $sub_attributes, $li_attributes);
    }

    /**
     * Generates Bootstrap navigation tabs.
     * 
     * @see
     * 
     * @param array $elements array of uri => name 
     * @param array|string $actives active tabs
     * @param array $attributes
     * @return type
     */
    public static function nav_tabs(array $elements, $actives = NULL, array $attributes = NULL) {

        static::add_attribute($attributes, "nav-tabs");

        return static::navs($elements, $actives, $attributes);
    }

    /**
     * Media object implementation. Does not support media listing.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#media
     * 
     * @param string $object your object must have the media-object class.
     * @param string $body is the content. It is suggested to add a title (h1, 
     * h2, h3, ...) having the media-heading class such as 
     * 
     * <h4 class="media-heading">Here your title</h4>
     * <p>Dispose your content like you want</p>
     * 
     * @param array $attributes attributes to apply on media div.
     * @return string
     */
    public static function media($object, $body, array $attributes = NULL) {

        static::add_attribute($attributes, "media");

        $output = "<div " . HTML::attributes($attributes) . ">";

        // Adding media object within an anchor
        $output .= "<div " . HTML::attributes(array("class" => "pull-left media-object")) . ">$object</div>";

        // Adding media body
        $output .= "<div " . HTML::attributes(array("class" => "media-body")) . ">" . $body . "</div>";

        $output .= "</div>";

        return $output;
    }

    /**
     * Generate a bootstrap pagination given links.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#pagination
     * 
     * @param array $elements
     * @param array|string $active can be an active key from $links or an array of active
     * keys.
     * @param array $attributes attributs css appliqué au div.
     * @return string
     */
    public static function pagination(array $elements, $actives = NULL, array $attributes = array()) {

        if ($actives === NULL) {
            $actives = array();
        }

        if (!Arr::is_array($actives)) {
            $actives = array($actives);
        }

        static::add_attribute($attributes, "pagination");

        $output = "<div " . HTML::attributes($attributes) . "><ul>";

        foreach ($elements as $key => $value) {
            $output .= "<li " . HTML::attributes(array("class" => (in_array($key, $actives) ? "active" : ""))) . ">";
            $output .= $value;
            $output .= "</li>";
        }

        $output .= "</ul></div>";

        return $output;
    }

    /**
     * Generates a Bootstrap progress bar.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#progress
     * 
     * @param string $message
     * @param string $type
     * @param array $attributes
     * @return string
     */
    public static function progress($progress, $type = "", array $attributes = NULL) {

        static::add_attribute($attributes, "progress progress-$type");

        $output = "<div " . HTML::attributes($attributes) . ">";

        $atts = array("class" => "bar");

        // Support for multiple progress bars
        if (Arr::is_array($progress)) {
            foreach ($progress as $p) {
                $atts["style"] = "width: $p%;";
                $output .= "<div " . HTML::attributes($atts) . " />";
            }
        } else {
            $atts["style"] = "width: $progress%;";
            $output .= "<div " . HTML::attributes($atts) . " />";
        }

        $output .= "</div>";

        return $output;
    }

    /**
     * Generates a Bootstrap split button.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#buttonSplitbutton
     * 
     * @todo support for active elements in dropdown
     * 
     * @param array $elements liste des éléments à disposer dans le split button.
     * @param string $type
     * @return string
     */
    public static function split_button(array $elements, $type = "", array $attributes = NULL, array $button_attributes = NULL, array $dropdown_attributes = NULL) {

        if (count($elements) === 0) {
            return "";
        }

        // If only one element is specified, we draw a simple button

        if (count($elements) === 1) {
            return array_shift($elements);
        }

        static::add_attribute($attributes, "btn-group");

        $output = "<div " . HTML::attributes($attributes) . ">";

        // First element can be a link
        $keys = array_keys($elements);

        $output .= array_shift($elements);

		if ( ! isset($button_attributes['class']))
		{
			$button_attributes['class'] = '';
		}

		$button_attributes['class'] .= ' dropdown-toggle';

		$button_attributes = Arr::merge(array('data-toggle' => 'dropdown'), $button_attributes);

        // Dropdown button in this case has no title, just a caret
        $output .= static::button(static::CARET, NULL, NULL, $type, $button_attributes);

        $output .= static::dropdown($elements, NULL, $dropdown_attributes);

        $output .= "</div>";

        return $output;
    }

    /**
     * Bootstrap well implementation.
     * 
     * @see http://twitter.github.com/bootstrap/components.html#misc
     * 
     * @param string $message is the content to be presented in a well.
     * @param string $size is the size which could be small or large.
     * @param array $attributes is an array of extra attributes to apply on the
     * well.
     * @return string
     */
    public static function well($message, $size = "", array $attributes = NULL) {

        static::add_attribute($attributes, "well");
        static::add_attribute($attributes, "well-$size");

        return "<div " . HTML::attributes($attributes) . ">" . $message . "</div>";
    }

}

?>
