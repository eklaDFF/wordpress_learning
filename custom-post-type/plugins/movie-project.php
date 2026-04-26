<?php

/**
 * Plugin Name: Movie Project
 * Description: Registers Movie CPT and Taxonomies
 * Version: 1.0
 * Author: Your Name
 */


function create_movie_post_type() {
    
    $labels = array(
        'name'          => 'Movies',
        'singular_name' => 'Movie',
        'add_new'       => 'Add New Movie',
        'add_new_item'  => 'Add New Movie',
        'edit_item'     => 'Edit Movie',
        'all_items'     => 'All Movies',
        'menu_name'     => 'Movies',
    );

    $args = array(
        'labels'      => $labels,
        'public'      => true,
        'has_archive' => true,
        'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'   => 'dashicons-video-alt2',
        'rewrite'     => array( 'slug' => 'movies' ),
    );

    register_post_type( 'movie', $args );
}

add_action( 'init', 'create_movie_post_type' );


function create_movie_taxonomies() {

    // ----- GENRE TAXONOMY -----
    $genre_labels = array(
        'name'          => 'Genres',
        'singular_name' => 'Genre',
        'search_items'  => 'Search Genres',
        'all_items'     => 'All Genres',
        'edit_item'     => 'Edit Genres',
        'add_new_item'  => 'Add New Genre',
        'menu_name'     => 'Genres',   // ✅ fixed: was 'menu_item'
    );

    register_taxonomy(
        'genre',
        'movie',
        array(
            'labels'       => $genre_labels,
            'hierarchical' => true,    // ✅ correct spelling
            'public'       => true,
            'rewrite'      => array( 'slug' => 'genre' ),
        )
    );


    // ----- DIRECTOR TAXONOMY -----
    $director_labels = array(
        'name'          => 'Directors',
        'singular_name' => 'Director',
        'search_items'  => 'Search Director',
        'all_items'     => 'All Directors',
        'edit_item'     => 'Edit Director',
        'add_new_item'  => 'Add New Director',
        'menu_name'     => 'Directors',  // ✅ fixed: was 'menu_item'
    );

    register_taxonomy(
        'director',
        'movie',
        array(
            'labels'       => $director_labels,
            'hierarchical' => false,   // ✅ fixed: was 'hierachical'
            'public'       => true,
            'rewrite'      => array( 'slug' => 'director' ),
        )
    );
}

add_action( 'init', 'create_movie_taxonomies' );
