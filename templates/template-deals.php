<?php /*Template name: page des offres d'emplois*/ ?>
<?php get_header(); ?> 
<div class="pageHeader deals">
    <div class="pageHeader__clip">
        <h1 class="pageHeader__title">
            <?= the_title(); ?>
        </h1>
        <p class="pageHeader__content">
            <?= get_field('header__description'); ?>
        </p>
    </div>
</div>
<section class="offers">
    <h2 class="sr-only">Toutes les offres d'emplois</h2>
    <?php $currentPage = get_query_var('paged'); $offers = new WP_Query(array('post_type' => 'jobs', 'posts_per_page' => 6, 'paged' => $currentPage)); ?>
    <?php while($offers->have_posts()) : $offers->the_post(); ?>
        <article class="offer">
            <div class="offer__img"><?= get_avatar(get_the_author_id()); ?></div>
            <div class="offer__all">
                <h2 class="offer__title"><?php the_title(); ?></h2>
                <div class="offer__infos">
                <span class="offer__company"><?= get_field('offer__name')?></span><span class="offer__location"><?= get_field('offer__location'); ?></span><span class="offer__date">Le <?= get_the_date(); ?></span>
                </div>
                <ul class="offer__tags">
                    <?php $tags = get_the_tags(get_the_ID());?>
                    <?php foreach($tags as $tag): ?>
                    <li class="tag <?= $tag->slug; ?>">
                        <?= $tag->name; ?>     
                    </li>
                    <?php endforeach; ?>
                </ul> 
                <div class=" offer__content wysiwyg">
                    <?= get_field('offer__content'); ?>
                </div>
                <div class="offer__infos">
                <span class="offer__email"><a href="mailto:<?= get_field('offer__email')?>"><?= get_field('offer__email')?></a></span><span class="offer__phone"><?= get_field('offer__phone'); ?>
                </div>
            </div>
        </article>
    <?php endwhile;?>
    <?php wp_reset_query(); ?>   
</section>
<div class="paginate emplois">
    <div class="paginate__clip">
        <?= paginate_links(array(
            'total' => $offers->max_num_pages,
            'end_size' => 1,
            'mid_size' => 3,
            'prev_next' => false
        )); ?> 
    </div>
</div>


</body>
<footer class="pageFooter deals">
    
<?php get_footer(); ?> 