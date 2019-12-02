<?php /*Template name: page des snippets*/ ?>
<?php get_header(); ?>
<div class="pageHeader snippets">
    <div class="pageHeader__clip">
        <div class="container">
            <h1 class="pageHeader__title">
                <?= the_title(); ?>
            </h1>
            <p class="pageHeader__content">
                <?= get_field('header__description'); ?>
            </p>
        </div>
    </div>
</div>
<div class="container">

</div>
<div class="paginate paginate__snippet">
    <div class="paginate__clip">
        <?= paginate_links(array(
            'total' => $jobs->max_num_pages,
            'end_size' => 1,
            'mid_size' => 3,
            'prev_next' => false
        )); ?>
        <!-- <?php if ($jobs->have_posts()) : while ($jobs->have_posts()) : $jobs->the_post(); ?>
        <?php if ($_GET['recherche']) : ?>
        <p>vortre recherche : <?= $_GET['recherche']; ?></p>
        <?php endif; ?>
        <?php endwhile;
        else : ?>
        <p>Il n'y a pas de réponse a votre recherche</p>
        <p>vortre recherche : <?= $_GET['recherche']; ?></p>        
        <?php endif; ?> -->
        <?php wp_reset_query(); ?>
    </div>
</div>
</body>
<footer class="pageFooter snippets">

    <?php get_footer(); ?>