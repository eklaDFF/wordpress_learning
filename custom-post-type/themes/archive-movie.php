<?php get_header(); ?>

<main>
    <h1>All Movies</h1>

    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>

            <article style="margin-bottom: 30px; border-bottom: 1px solid #ccc; padding-bottom: 20px;">

                <h2>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>

                <?php
                // GENRE
                $genres = get_the_terms( get_the_ID(), 'genre' );
                if ( $genres && ! is_wp_error( $genres ) ) :
                ?>
                    <p>
                        <strong>Genre:</strong>
                        <?php
                        foreach ( $genres as $genre ) {
                            echo '<a href="' . esc_url( get_term_link( $genre ) ) . '">'
                                . esc_html( $genre->name )
                                . '</a> ';
                        }
                        ?>
                    </p>
                <?php endif; ?>

                <?php
                // DIRECTOR
                $directors = get_the_terms( get_the_ID(), 'director' );
                if ( $directors && ! is_wp_error( $directors ) ) :
                ?>
                    <p>
                        <strong>Director:</strong>
                        <?php
                        foreach ( $directors as $director ) {
                            echo esc_html( $director->name ) . ' ';
                        }
                        ?>
                    </p>
                <?php endif; ?>

				<?php
				$release_year = get_post_meta( get_the_ID(), 'release_year', true );
				$rating       = get_post_meta( get_the_ID(), 'rating', true );
				$runtime      = get_post_meta( get_the_ID(), 'runtime', true );
				$language     = get_post_meta( get_the_ID(), 'language', true );
				?>

				<?php if ( $release_year ) : ?>
    				<p><strong>Year:</strong> <?php echo esc_html( $release_year ); ?></p>
				<?php endif; ?>

				<?php if ( $rating ) : ?>
    				<p><strong>Rating:</strong> <?php echo esc_html( $rating ); ?> / 10</p>
				<?php endif; ?>

				<?php if ( $runtime ) : ?>
    				<p><strong>Runtime:</strong> <?php echo esc_html( $runtime ); ?></p>
				<?php endif; ?>

				<?php if ( $language ) : ?>
    				<p><strong>Language:</strong> <?php echo esc_html( $language ); ?></p>
				<?php endif; ?>

                <p><small><?php the_date(); ?></small></p>

            </article>

        <?php endwhile; ?>

        <?php the_posts_pagination(); ?>

    <?php else : ?>
        <p>No movies found.</p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>