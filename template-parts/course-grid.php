<?php $all_terms = $args['itineris_query'];

    if ( $all_terms->have_posts() ) :?>
        <div class="all-grids">
        <?php while ( $all_terms->have_posts() ) : $all_terms->the_post(); $id = $post->ID ?>
            <div class="grid">
                <div>
                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo $post->post_name ?>">
                </div>
                <div>
                    <h2><?php echo $post->post_title?></h2>
                    <p>
                        <?php $get_type = isset(get_the_terms($id, 'Course-type')[0]) ? get_the_terms($id, 'Course-type')[0] : ''?>
                        <span><?php echo $get_type->name ?></span>
                        <span><?php echo get_post_meta( $id, 'Duration', true )?></span>
                    </p>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
<?php endif;
