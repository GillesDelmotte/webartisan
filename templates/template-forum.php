<?php /*Template name: page du forum*/ ?>
<?php
if (!is_user_logged_in()) {
    $disabled = true;
} else {
    $disabled = false;
}
?>
<?php  
    $currentPage = get_query_var('paged');
    $articles = new WP_Query(array('s' => $_GET['title'], 'post_type' => 'forum', 'posts_per_page' => 6, 'paged' => $currentPage)); 
    tags_filter($articles);
?>
<?php get_header(); ?>
<div class="pageHeader forum">
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
    <section class="subjects">
        <h2 class="sr-only">
            Tous les sujets du forum
        </h2>
        <div class="filter forum">
            <input type="checkbox" name="filter" class="sr-only filter__input" id="filter">
            <label for="filter" class="filter__button--open" title="ouvrir la fenêtre du filtre"><i></i></label>
            <div class="filter__window">
                <label for="filter" class="filter__button--close">
                    <i></i>
                </label>
                <h3 class="filter__window__title">Filtre</h3>
                <form action="">
                    <div class="form__field title">
                        <label required for="title" class="form__field__label">Titre de l'annonce&nbsp;:</label>
                        <div class="form__field__input">
                            <input type="text" list="article" id="title" name="title" value="<?= $_GET['title']; ?>" placeholder="Le titre de l'annonce ici">
                            <datalist id="article">
                                <?php while ($articles->have_posts()) : $articles->the_post(); ?>
                                    <option value="<?= the_title(); ?>">
                                <?php endwhile; ?>
                                <?php wp_reset_query(); ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="form__field title">
                        <label for="tags" class="form__field__label">tags&nbsp;:</label>
                        <div class="form__field__input">
                            <!-- <input type="text" id="tags" name="tags" value="<?= $_GET['tags']; ?>" placeholder="votre tag ici"> -->
                            <select class="custom-select" id="tags" name="tags">
                                <option value="">Choisissez un tag</option>
                                <option value="" disabled>-----------------------------------------</option>
                                <?php foreach(get_tags() as $tag): ?>
                                <option value="<?= $tag->name; ?>"><?= $tag->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="form__submit">rechercher</button>
                </form>
            </div>
        </div>
        
        <?php if ($articles->have_posts()) : while ($articles->have_posts()) : $articles->the_post(); ?>
            <article class="offer">
                <div class="offer__img"><?= get_avatar(get_the_author_id()); ?></div>
                <div class="offer__all">
                    <h3 class="offer__title"><?php the_title(); ?></h3>
                    <div class="offer__infos">
                        <span class="offer__company"><?= get_the_author(); ?></span><span class="offer__date">Le <?= get_the_date(); ?></span><span class="offer__comments"><?= $number = get_comments_number(get_the_ID()) ?> <?= $number > 1 ? 'Réponses' : 'Réponse'; ?></span>
                    </div>
                    <ul class="offer__tags">
                        <?php $tags = get_the_tags(get_the_ID()); ?>
                        <?php foreach ($tags as $tag) : ?>
                            <li class="tag <?= $tag->slug; ?>">
                                <a href="<?= home_url( $wp->request ); ?>/?title=&tags=<?= $tag->slug; ?>"></a>
                                <?= $tag->name; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class=" offer__content wysiwyg">
                        <p>
                            <?= get_field('forum__resume') ?>
                        </p>
                    </div>
                </div>
                <a href="<?= the_permalink(); ?>" class="offer__link"></a>
            </article>
        <?php endwhile; elseif(!empty($_GET['title'])): ?>
        <div class="noSearch">
            <p>Il n'y a aucun résultat pour cette recherche  : "<?= $_GET['title']; ?>"</p>
        </div>
        <?php else: ?> 
          <div class="noSearch">
            <p>Il n'y a aucun post sur le forum</p>
        </div>     
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </section>
</div>
<div class="paginate forum">
    <div class="paginate__clip">
        <?= paginate_links(array(
            'total' => $articles->max_num_pages,
            'end_size' => 1,
            'mid_size' => 3,
            'prev_next' => false
        )); ?>
    </div>
</div>
<div class="container">
    <section class="newArticle">
        <h2 class="newArticle__title">Publier un nouveau article</h2>
        <form action="<?= admin_url('admin-post.php'); ?>" method="post" class="newArticle__form">
            <input type="hidden" name="action" value="post_newArticle">
            <div class="form__field title">
                <label  for="title" class="form__field__label">Titre de l'annonce*&nbsp;:</label>
                <div class="form__field__input">
                    <input type="text" required id="title" name="title" placeholder="Le titre de l'annonce ici" <?= $disabled ? "disabled" : ""; ?>>
                </div>
            </div>
            <div class="form__field tags">
                <label for="tags" class="form__field__label">Tags*&nbsp;:</label>
                <div class="form__field__input">
                    <input required type="text" id="tags" name="tags" placeholder="Css,Html,Javascript" <?= $disabled ? "disabled" : ""; ?>>
                </div>
            </div>
            <div class="form__field resume">
                <label for="resume" class="form__field__label">Résumé de votre article*&nbsp;:</label>
                <div class="form__field__input">
                    <input required type="text" id="resume" name="resume" placeholder="Votre résumé ici" <?= $disabled ? "disabled" : ""; ?>>
                </div>
            </div>
            <div class="form__field desc">
                <label for="desc" class="form__field__label">Description*&nbsp;:</label>
                <div class="form__field__input">
                    <textarea required name="desc" id="desc" <?= $disabled ? "disabled" : ""; ?>></textarea>
                </div>
            </div>
            <input type="submit" value="Créer l'article" class="form__submit" <?= $disabled ? "disabled" : ""; ?>>
        </form>
        <?php if ($disabled) : ?>
            <div class="disabled">
                <p>Vous devez être connecté pour pouvoir faire une offre</p>
                <a class="disabled__connection" href="<?= the_permalink(106); ?>">Me connecter</a>
            </div>
        <?php endif; ?>
    </section>
    <div class="container">
        <div class="form__explanation">
                <p>
                    Pour ajouter une coloration syntaxique, copier coller les raccourcis suivants :
                </p>
                <ul>
                    <li>Code : <span>[code]…[/code]</span></li>
                    <li>HTML : <span>[code=html]…[/code]</span></li>
                    <li>CSS : <span>[code=css]…[/code]</span></li>
                    <li>PHP : <span>[code=php]…[/code]</span></li>
                    <li>JAVASCRIPT : <span>[code=javascript]…[/code]</span></li>
                    <li>MySQL : <span>[code=sql]…[/code]</span></li>
                </ul>
        </div>
    </div>
    

</div>
</body>
<footer class="pageFooter forum">

    <?php get_footer(); ?>