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

        <p style="text-align: justify; font-size:16px;">Congratulations on finding this page! Your world is about to change! You are about to become stronger, thinner, healthier and happier - you are no longer alone!</p>
        <p style="text-align: justify;font-size:16px;">Question - Is it possible for ten years to pass and you actually get younger?</p>
        <p>Answer - Yes it is, and the proof is in the picture below. Dr. David Madow has figured out how to make time work FOR you instead of against you, and he is now ready to share this knowledge. Call him your coach, your teacher, your guru... it doesn't matter. What does matter is that your life is about to change and you are about to turn back the clock and “Slice Your Age!”</p>
        <p style="text-align:center;margin-left:auto;margin-right:auto;"><img src="http://www.davidmadow.com/wp-content/uploads/2014/02/davidmadow400.jpg" /></p>
        <p>Where should you start? There are many resources here to guide you. We suggest listening to the "Slice Your Age" podcast (scroll down below) because it offers easy, fun and practical advice you can use to get into the best shape of your life. If you like the podcast, we HIGHLY recommend subscribing through the the iTunes button (on the right side of this page) so you won't miss any episodes. Also, feel free to tell your friends about us! We love the support, and your friends might thank you for turning them on to this site!</p>
        <p style="text-align: justify; border-bottom:1px solid #ddd;padding-bottom:5px">Want to know more? <a href="/about-me/">Simply click here!</a></p>

			<?php /* The loop */ ?>
			<!--<?php query_posts('showposts=30&cat=37&order=DESC&posts_per_page=2'); ?>-->			<?php query_posts( array ( 'category_name' => 'podcast', 'posts_per_page' => 150 ) ); ?>
			<?php while ( have_posts() ) : the_post(); ?>

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

				<?php comments_template(); ?>
			<?php endwhile; ?>

		 </main><!-- #content -->

<?php get_sidebar(); ?>
</div><!-- #primary -->
<?php get_footer(); ?>
