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


function movie_meta_box() {
    add_meta_box(
        'movie_details',                        // a unique ID for this meta
        'Movie Details',                        // title shown in wp-admin
        'movie_meta_box_html_cb',               // callback function which will output the HTML Form
        'movie',                                // screen on which this meta box will be displayed on
        'normal',                               // position e.g. 'normal', 'side', 'advanced'
        'high'                                  // priority
    );
}

add_action( 'add_meta_boxes', 'movie_meta_box' );


function movie_meta_box_html_cb( $post ) {

    wp_nonce_field( 'save_movie_details', 'movie_nonce' );

    $release_year = get_post_meta( $post->ID, 'release_year', true );
    $rating       = get_post_meta( $post->ID, 'rating',       true );
    $runtime      = get_post_meta( $post->ID, 'runtime',      true );
    $language     = get_post_meta( $post->ID, 'language',     true );

    echo '<table style="width:100%;">';

        echo '<tr>
            <td style="padding:8px 0; width:150px;">
                <label for="release_year"><strong>Release Year</strong></label>
            </td>
            <td>
                <input type="number" id="release_year" name="release_year"
                    value="' . esc_attr( $release_year ) . '"
                    placeholder="e.g. 2010" style="width:200px;" />
            </td>
        </tr>';

        echo '<tr>
            <td style="padding:8px 0;">
                <label for="rating"><strong>IMDb Rating</strong></label>
            </td>
            <td>
                <input type="number" id="rating" name="rating"
                    value="' . esc_attr( $rating ) . '"
                    placeholder="e.g. 9.2" step="0.1" min="0" max="10"
                    style="width:200px;" />
            </td>
        </tr>';

        echo '<tr>
            <td style="padding:8px 0;">
                <label for="runtime"><strong>Runtime</strong></label>
            </td>
            <td>
                <input type="text" id="runtime" name="runtime"
                    value="' . esc_attr( $runtime ) . '"
                    placeholder="e.g. 148 mins" style="width:200px;" />
            </td>
        </tr>';

        echo '<tr>
            <td style="padding:8px 0;">
                <label for="language"><strong>Language</strong></label>
            </td>
            <td>
                <input type="text" id="language" name="language"
                    value="' . esc_attr( $language ) . '"
                    placeholder="e.g. English" style="width:200px;" />
            </td>
        </tr>';

    echo '</table>';
}


function save_movie_meta( $post_id ) {
    if( isset( $_POST[ 'release_year' ] ) ) {
        update_post_meta( $post_id, 'release_year', $_POST[ 'release_year' ] );
    }
    if( isset( $_POST[ 'rating' ] ) ) {
        update_post_meta( $post_id, 'rating', $_POST[ 'rating' ] );
    }
    if ( isset( $_POST['runtime'] ) ) {
        update_post_meta( $post_id, 'runtime', sanitize_text_field( $_POST['runtime'] ) );
    }
    if ( isset( $_POST['language'] ) ) {
        update_post_meta( $post_id, 'language', sanitize_text_field( $_POST['language'] ) );
    }
}

add_action( 'save_post', 'save_movie_meta' );