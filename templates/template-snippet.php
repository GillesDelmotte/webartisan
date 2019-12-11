<?php /*Template name: page des tutoriels*/ ?>
<?php 
$currentPage = get_query_var('paged');
$tutos = new WP_Query(array('s' => $_GET['title'], 'post_type' => 'tutos', 'posts_per_page' => 6, 'paged' => $currentPage)); tags_filter($tutos);
?>
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
    <section class="offers">
        <h2 class="sr-only">Toutes les offres d'emplois</h2>
        <div class="filter snippets">
            <input type="checkbox" name="filter" class="sr-only filter__input" id="filter">
            <label for="filter" class="filter__button--open"><i></i></label>
            <div class="filter__window">
                <label for="filter" class="filter__button--close">
                    <i></i>
                </label>
                <h3 class="filter__window__title">Filtre</h3>
                <form action="">
                    <div class="form__field title">
                        <label required for="title" class="form__field__label">Titre de l'annonce*&nbsp;:</label>
                        <div class="form__field__input">
                            <input type="text" id="title" name="title" value="<?= $_GET['title']; ?>" placeholder="Le titre de l'annonce ici">
                        </div>
                    </div>
                    <div class="form__field title">
                        <label required for="tags" class="form__field__label">tags*&nbsp;:</label>
                        <div class="form__field__input">
                            <input type="text" id="tags" name="tags" value="<?= $_GET['tags']; ?>" placeholder="votre tag ici">
                        </div>
                    </div>
                    <button type="submit" class="form__submit">rechercher</button>
                </form>
            </div>
        </div>

        <?php while ($tutos->have_posts()) : $tutos->the_post(); ?>
            <article class="offer">
                <div class="offer__all">
                    <h3 class="offer__title"><?php the_title(); ?></h3>
                    <ul class="offer__tags">
                        <?php $tags = get_the_tags(get_the_ID()); ?>
                        <?php foreach ($tags as $tag) : ?>
                            <li class="tag <?= $tag->slug; ?>">
                                <?= $tag->name; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class=" offer__content wysiwyg">
                        <?= get_field('tuto__desc'); ?>
                    </div>
                </div>
                <a href="<?php the_permalink(); ?>" class="offer__link"></a>
            </article>
        
    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
    </section>
</div>
<div class="paginate paginate__snippet">
    <div class="paginate__clip">
        <?= paginate_links(array(
            'total' => $tutos->max_num_pages,
            'end_size' => 1,
            'mid_size' => 3,
            'prev_next' => false
        )); ?>
    </div>
</div>
</body>
<footer class="pageFooter snippets">

    <?php get_footer(); ?>