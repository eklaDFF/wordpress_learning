<?php
/**
 * Plugin Name: Shortcode Plugin Example
 * Description: This plugin is an example of creating a shortcode.
 * Version: 1.0
 * Author: Ekla
 */



// Basic Shortcode Example

add_shortcode("message", "message_shortcode_cb");

function message_shortcode_cb(){
    $hour = date('H');

    if($hour < 12){
        return "<p style='color:orange; font-size:36px; font-weight:bold'>Good Morning</p>";
    }elseif($hour < 17){
        return "<p style='color:green; font-size:36px; font-weight:bold'>Good Afternoon</p>";
    }else{
        return "<p style='color:black; font-size:36px; font-weight:bold'>Good Evening</p>";
    }
}


// Shortcode with parameters

add_shortcode("student", "student_shortcode_cb");

function student_shortcode_cb($attributes){
    $attributes = shortcode_atts(array("name"=>"Student_Name", "university_id"=>"0000000000000"), $attributes, "student");

    return "<p>{$attributes['name']}<br>{$attributes['university_id']}</p>";
}


// Shortdoe with DB operations

add_shortcode("list-posts", "list_posts_shortcode_cb");

function list_posts_shortcode_cb(){
    global $wpdb;

    $table_name_prefix = $wpdb->prefix;
    $table_name = $table_name_prefix."posts";

    $posts = $wpdb->get_results("SELECT post_title FROM {$table_name} WHERE post_type = 'post' AND post_status = 'publish'");

    $output = "<ul>";

    foreach($posts as $post){
        $output .= "<li>".$post->post_title."</li>";
    }

    $output .= "</ul>";

    return $output;
}

