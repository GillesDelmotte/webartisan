<?php 
/* Template Name: Search Page */ 
global $wp_query;
$s = get_search_query();
$args = array(
    'post_type' => array('actualities', 'forum', 'tutos', 'jobs', 'worker', 'mdn'),
    's' => $s,
    'orderby' => 'post_type',
    'order' => 'ASC',
    'showposts' => 1000,
);
$query = new WP_Query( $args );
get_header();
?>
<div class="pageHeader homepage">
<div class="pageHeader__clip">
        <div class="container">
            <h1 class="pageHeader__title">
               Recherche
            </h1>
        </div>
    </div>
</div> 
<div class="container">
<section class="search">
    <h2 class="sr-only">
        Le resultat de votre recherche
    </h2>
    <div class="noSearch">
    <p>Votre recherche est :"<?= $_GET['s']; ?>"</p>
</div> 
<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
 
<article class="offer">
    <div class="offer__all">
        <h2 class="offer__title">
            <?php if(get_post_type() === 'worker'){
                echo get_field('job__name') . ' : ';
                } ;
            ?>
            <?php the_title(); ?>
        </h2>
        <div class="offer__infos">
            <span class="offer__date">Le <?= get_the_date(); ?></span><span class="post__type"><?= get_post_type(); ?></span>
        </div>
        <ul class="offer__tags">
            <?php $tags = get_the_tags(get_the_ID()); ?>
            <?php foreach ($tags as $tag) : ?>
                <li class="tag <?= $tag->slug; ?>">
                    <?= $tag->name; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <a href="<?php the_permalink(); ?>" class="offer__link"></a>
</article>
<?php endwhile;else:?> 
<div class="noSearch">
    <p>Il n'y a aucun résultat pour cette recherche : "<?= $_GET['s']; ?>"</p>
</div>    
<?php endif; ?>

</section>
</div>

</body>
<footer class="pageFooter homepage">
<?php get_footer(); ?>