<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
                'numberposts' => 3,
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
        <?
        $home_posts = get_posts([
                'numberposts' => 3,
                'post_type' => 'products',
                'meta_query' => array(
                    array(
                        'key' => 'price'
                    ),
                    array(
                        'key' => 'price'
                    ),
                ),
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
            ]
        );
        ?>
        <div class="container">
            <div class="row mb-5">
                <? foreach ($home_posts as $home_post) : ?>
                    <div class="col-md-6 col-lg-3 mb-2 mb-lg-1 blog-entry card">
                        <img src="<? echo carbon_get_post_meta($home_post->ID, 'img') ?>" class="card-img-top" alt=""
                             width="300" height="200">
                        <div class="card-body">
                            <a href="<? echo get_permalink($home_post->ID) ?>">
                                <h5 class="card-title"><? echo get_the_title($home_post->ID) ?></h5></a>
                            <? if (carbon_get_post_meta($home_post->ID, 'price')): ?>
                                <p class="card-text">
                                    Стоимость: <? echo carbon_get_post_meta($home_post->ID, 'price') ?></p>
                            <? else: ?>
                                <p class="card-text">Стоимость: цена не указана</p>
                            <? endif; ?>
                            <p class="card-text">Описание: <? echo carbon_get_post_meta($home_post->ID, 'text') ?></p>

                            <? if (carbon_get_post_meta($home_post->ID, 'crb_content_align')): ?>
                                <p class="card-text">
                                    Производитель: <? echo carbon_get_post_meta($home_post->ID, 'crb_content_align') ?></p>
                            <? endif; ?>
                            <? if (carbon_get_post_meta($home_post->ID, 'complekt')): ?>
                                <p class="card-text">
                                    Комплектация: <? echo carbon_get_post_meta($home_post->ID, 'complekt') ?></p>
                            <? endif; ?>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </main>

<?php
get_footer();
