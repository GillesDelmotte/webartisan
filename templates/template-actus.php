<?php /*Template name: page actualités*/ ?>
<?php get_header(); ?>
<div class="pageHeader actu">
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
    <section class="articles">
        <h2 class="sr-only">Tous les articles</h2>
        <div class="filter actus">
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
        <?php $currentPage = get_query_var('paged');
        $actus = new WP_Query(array('s' => $_GET['title'], 'post_type' => 'actualities', 'posts_per_page' => 4, 'paged' => $currentPage)); tags_filter($actus); ?>
        <?php while ($actus->have_posts()) : $actus->the_post(); ?>
            <article class="article">
                <h3 class="article__title"><a href="<?= the_permalink(); ?>"><?= the_title(); ?></a></h3>
                <div class="article__infos">
                    <span class="article__date">Le <?= get_the_date(); ?></span><span class="article__author"><?= get_author_name(); ?></span>
                </div>
                <div class="article__img">
                    <?php $img = get_field('actu__img');
                        $size = 'thumb_690x300' ?>
                    <?= wp_get_attachment_image($img, $size); ?>
                </div>
                <p class="article__resume"><?= get_field('actu__resume'); ?></p>

                <ul class="article__tags">
                    <?php $tags = get_the_tags(get_the_ID()); ?>
                    <?php foreach ($tags as $tag) : ?>
                        <li class="tag <?= $tag->slug; ?>">
                            <?= $tag->name; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </article>
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
    </section>
</div>
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