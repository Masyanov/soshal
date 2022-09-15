<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package test7
 */

?>

	<footer id="colophon" class="site-footer">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'test7' ) ); ?>">
                    <?php
                    /* translators: %s: CMS name, i.e. WordPress. */
                    printf( esc_html__( 'Proudly powered by %s', 'test7' ), 'WordPress' );
                    ?>
                </a>
            </div>
        </nav>
	</footer><!-- #colophon -->
</div><!-- #page -->
<script src= "../wp-content/themes/BootSTheme/dist/js/bootstrap.js" ></script>

<?php wp_footer(); ?>

</body>
</html>
