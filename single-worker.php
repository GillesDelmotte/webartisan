<?php get_header(); ?> 
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article class="single__job">
    <div class="pageHeader jobs">
        <div class="pageHeader__clip pageHeader__clip--small">
            <h1 class="pageHeader__title">
                Les métiers du web <span><?= get_field('job__name'); ?> - <?php the_title(); ?></span>
            </h1>
            <p class="pageHeader__content"><?= get_field('job__introduction'); ?></p>
        </div>
    </div>
    <div class="job__person__infos">
        <div class="job__person__infos__img">
            <?php $img = get_field('job__img'); $size = 'thumb_285x350' ?>
            <?= wp_get_attachment_image( $img, $size ); ?>
        </div>
    </div>
    <div class="interview">
            <div class="interview__content">
                <?php if (have_rows('interview')) : while (have_rows('interview')) : the_row(); ?>

                    <?php include 'inc/' . get_row_layout() . '.php'; ?>

                <?php endwhile; endif; ?>
            </div>  
    </div>
    
</article>
<section class="other">
    <h2 class="other__title">D'autres métiers du web</h2>
    <div class="other__pics">
        <?php $args = new WP_Query(array( 'post_type' => 'worker', 'posts_per_page' => 4, 'orderby' => 'rand')); ?>
        <ul class="persons">
        <?php while($args->have_posts()) : $args->the_post(); ?>
        <li class="person">
            <a href="<?= the_permalink(); ?>" class="person__link"><span class="sr-only">interview de <?= get_field('job__name');?> (<?= the_title();?>)</span></a>
            <?php $img = get_field('job__img'); $size = 'thumb_285x350' ?>
            <?= wp_get_attachment_image( $img, $size ); ?>
            <div class="person__infos">
                <span class="person__name"><?= get_field('job__name');?></span>
                <span class="person__job"><?= the_title();?></span>
            </div>
        </li>
        <?php endwhile;?>
        <?php wp_reset_query(); ?>   
    </ul>
    </div>
</section>
</body>
<?php endwhile; endif;?>
<footer class="pageFooter jobs"> 
 
<?php get_footer(); ?> 