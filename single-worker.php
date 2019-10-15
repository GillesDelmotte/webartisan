<?php get_header(); ?> 
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article class="single__job">
    <div class="pageHeader jobs">
        <div class="pageHeader__clip pageHeader__clip--small">
            <h1 class="pageHeader__title">
                Les métiers du web <span><?= the_title(); ?></span>
            </h1>
            <p class="pageHeader__content"><?= get_field('job__introduction'); ?></p>
        </div>
    </div>
    <div class="job__person__infos">
        <div class="job__person__infos__img">
            <?php $img = get_field('job__img'); $size = 'thumb_285x350' ?>
            <?= wp_get_attachment_image( $img, $size ); ?>
        </div>
        <p class="person__name"><?= get_field('job__name'); ?></p>
    </div>
</article>
</body>
<footer class="pageFooter jobs"> 
<?php endwhile; else: ?>
<?php endif; ?>   
<?php get_footer(); ?> 