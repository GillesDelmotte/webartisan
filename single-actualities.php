<?php get_header(); ?> 
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="pageHeader actu">
    <div class="pageHeader__clip">
        <h1 class="pageHeader__title">
            <?= the_title(); ?>
        </h1>
    </div>
</div>
<div class="actu__thumbnail">
    <?php $img = get_field('actu__img'); $size = 'thumb_1184x500' ?>
    <?= wp_get_attachment_image( $img, $size ); ?>
</div>
<div class="actu__content">
    <?= get_field('actu__content'); ?>
</div>
</body>
<footer class="pageFooter actu"> 
<?php endwhile; else: ?>
<?php endif; ?>   
<?php get_footer(); ?> 