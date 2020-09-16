<?php get_header(); ?>

<main class="main container" role="main">

    <section class="col-3">
        <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </section>

    <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>
