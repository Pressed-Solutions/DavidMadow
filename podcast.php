<?php
/**
 * Genesis Framework.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

//* Template Name: Podcast
get_header(); ?>

<div id="primary" class="content-area">
    <main class="content" itemtype="http://schema.org/Blog" itemscope="itemscope" itemprop="mainContentOfPage" role="main">

        <?php
        /* The content loop */
        while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'main-article' ); ?>>
            <?php the_content(); ?>
            </article>
        <?php endwhile;

        /* The archive loop */
        $podcast_query = new WP_Query( array (
            'category_name'  => 'podcast',
            'posts_per_page' => 150
        ) );
        if ( $podcast_query->have_posts() ) {
            while ( $podcast_query->have_posts() ) : $podcast_query->the_post();
        ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                        <div class="entry-thumbnail">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <?php endif; ?>

                        <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
    <?php echo do_shortcode('[powerpress]'); ?>
                        <div style="margin-bottom:60px;display:block;"><img src="http://www.davidmadow.com/wp-content/uploads/2014/03/Slice-Your-Age150.jpg" style="float:left;padding-right:15px;padding-bottom:15px;margin-bottom:25px;" /></div><div style="margin-top:-30px;"><?php the_excerpt(); ?></div><div style="clear:both;"><p>&nbsp;</p></div>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-meta">
                        <?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>

                    </footer><!-- .entry-meta -->
                </article><!-- #post -->

            <?php endwhile; ?>
        <?php } ?>
     </main><!-- #content -->

<?php get_sidebar(); ?>
</div><!-- #primary -->
<?php get_footer(); ?>
