<?php /*Template name: page actualités*/ ?>
<?php get_header(); ?> 
    <div class="pageHeader actu">
        <div class="pageHeader__clip">
            <h1 class="pageHeader__title">
                <?= the_title(); ?>
            </h1>
            <p class="pageHeader__content">
                <?= get_field('header__description'); ?>
            </p>
        </div>
    </div>
    <section class="articles">
            <h2 class="sr-only">Tous les articles</h2>
            <?php $currentPage = get_query_var('paged'); $actus = new WP_Query(array('post_type' => 'actualities', 'posts_per_page' => 4, 'paged' => $currentPage)); ?>
            <?php while($actus->have_posts()) : $actus->the_post(); ?>
                <article class="article">
                    <h2 class="article__title"><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a></h2>
                    <div class="article__infos">
                        <span class="article__date">Le <?= get_the_date(); ?></span><span class="article__author"><?= get_author_name(); ?></span>
                    </div>
                    <div class="article__img">
                        <?php $img = get_field('actu__img'); $size = 'thumb_690x300' ?>
                        <?= wp_get_attachment_image( $img, $size ); ?>
                    </div>
                    <p class="article__resume"><?= get_field('actu__resume'); ?></p>
                    
                    <ul class="article__tags">
                        <?php $tags = get_the_tags(get_the_ID()); ?>
                        <?php foreach($tags as $tag): ?>
                            <li class="tag <?= $tag->slug; ?>">
                                <?= $tag->name; ?>     
                            </li>
                        <?php endforeach; ?>
                    </ul>   
                </article>
            <?php endwhile;?>
            <?php wp_reset_query(); ?>   
        </section>
        
        <div class="paginate actu">
            <div class="paginate__clip">
                <?= paginate_links(array(
                    'total' => $actus->max_num_pages,
                    'end_size' => 1,
                    'mid_size' => 3,
                    'prev_next' => false
                )); ?> 
            </div>
        </div>
</body>
<footer class="pageFooter actu">
    
<?php get_footer(); ?> 
