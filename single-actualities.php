<?php get_header(); ?> 
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article class="single__actu">
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
    <div class="actu__infos">
        <span class="actu__date">Le <?= get_the_date(); ?></span><span class="actu__author"><?= get_author_name(); ?></span>
    </div>
    <ul class="actu__tags">
        <?php $tags = get_the_tags(get_the_ID());?>
        <?php foreach($tags as $tag): ?>
            <li class="tag <?= $tag->slug; ?>">
                <?= $tag->name; ?>     
            </li>
        <?php endforeach; ?>
    </ul> 
    <div class="actu__content wysiwyg">
        <?= get_field('actu__content'); ?>
    </div>
</article>

</body>
<footer class="pageFooter actu"> 
<?php endwhile; else: ?>
<?php endif; ?>   
<?php get_footer(); ?> 