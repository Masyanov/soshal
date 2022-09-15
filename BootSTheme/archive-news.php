<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test7
 */

get_header();
?>

	<main id="primary" class="site-main">

        <?
        $home_posts = get_posts([
                'numberposts' => -1,
                'post_type' => 'news',
                'orderby' => 'date',
                'order' => 'DESC',
            ]
        );
        ?>
        <div class="container">
            <div class="row mb-5 mt-5">
                <? foreach ($home_posts as $home_post) : ?>
                    <div class="col-md-6 col-lg-3 mb-2 mb-lg-1 blog-entry card">
                        <img src="<? echo carbon_get_post_meta($home_post->ID, 'img') ?>" class="card-img-top" alt=""
                             width="300" height="200">
                        <div class="card-body">
                            <a href="<? echo get_permalink($home_post->ID) ?>">
                                <h5 class="card-title"><? echo get_the_title($home_post->ID) ?></h5></a>
                            <time
                            "><?php echo carbon_get_post_meta($home_post->ID, 'date'); ?></time>
                            <p class="card-text"><? echo carbon_get_post_meta($home_post->ID, 'text') ?></p>

                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
	</main>

<?php

get_footer();
