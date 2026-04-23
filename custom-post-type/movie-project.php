<?php
	add_action( 'init', function() {

		register_post_type( 'movie', [
			'label' => 'Movies',
			'public' => true,
			'has_archive' => true,
			'supports' => ['title', 'editor', 'thumbnail'],
		]);

	});

	add_action( 'init', function() {
		register_taxonomy('genre', 'movie', [
			'label' => 'Genres',
			'public' => true,
		]);
	});
