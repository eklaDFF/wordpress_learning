<?php

/**
 * Plugin Name: Book Project
 * Description: Registers Movie CPT and Taxonomies
 * Version: 1.0
 * Author: Rahul Kumar
 */


function create_book_custom_post_type(){

    $labels = array(
        'name'            => 'Books',
        'singular_name'   => 'Book',
        'add_new'         => 'Add New Book',
        'add_new_item'    => 'Add New Book',
        'edit_item'       => 'Edit Book',
        'all_items'       => 'All Books',
        'menu_name'       => 'Books'
    );

    $args = array(
        'labels'          => $labels,
        'supports'        => array('title', 'editor', 'thumbnail', 'excerpt'),
        'public'          => true,
        'has_archive'     => true,
        'rewrite'         => array('slug' => 'books'),
    );

    register_post_type('book', $args);
}

add_action('init', 'create_book_custom_post_type');

function create_book_taxonomy(){
    // Gnere Taxonomy
    register_taxonomy(
        'book_genre',
        'book',
        array(
            'labels'       => array('name' => 'Book Genres', 'singular_name' => 'Book Genre', 'add_new_item' => 'Add New Book Genre', 'search_items' => 'Search Book Genre', 'menu_name' => 'Book Genres'),
            'hierarchical' => true,
            'public'       => true,
            'rewrite'      => array('slug' => 'book-genre')
        )
    );


    // Author Taxonomy
    register_taxonomy(
        'author',
        'book',
        array(
            'labels'       => array('name' => 'Authors', 'singular_name' => 'Author', 'add_new_item' => 'Add New Author', 'search_items' => 'Search Author', 'menu_name' => 'Authors'),
            'hierarchical'  => false,
            'public'       => true,
            'rewrite'      => array('slug' => 'author')
        )
    );
}

add_action('init', 'create_book_taxonomy');
