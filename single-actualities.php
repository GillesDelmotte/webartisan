<?php
if (!is_user_logged_in()) {
    $disabled = true;
} else {
    $disabled = false;
}
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="single__actu">
            <div class="pageHeader actu">
                <div class="pageHeader__clip">
                    <div class="container">
                        <h1 class="pageHeader__title">
                            <?= the_title(); ?>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="actu__thumbnail">
                    <?php $img = get_field('actu__img');
                            $size = 'thumb_1184x500' ?>
                    <?= wp_get_attachment_image($img, $size); ?>
                </div>
                <div class="actu__infos">
                    <span class="actu__date">Le <?= get_the_date(); ?></span><span class="actu__author"><?= get_author_name(); ?></span>
                </div>
                <ul class="actu__tags">
                    <?php $tags = get_the_tags(get_the_ID()); ?>
                    <?php foreach ($tags as $tag) : ?>
                        <li class="tag <?= $tag->slug; ?>">
                            <?= $tag->name; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="actu__content wysiwyg">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>
        <div class="container">
            <section class="comments actu">
                <h2 class="comments__title">
                    Commentaires
                </h2>
                <?php $comments = get_comments('post_id='.get_the_ID()); ?>
                <?php foreach($comments as $comment): ?>
                        <article class="offer">
                            <div class="offer__img"><?= get_avatar($comment->comment_author_url); ?></div>
                            <div class="offer__all">
                                <h2 class="offer__title">
                                    <?= $comment->comment_author; ?>
                                </h2>
                                <div class="offer__infos">
                                    <span class="offer__date">Le  <?= $comment->comment_date; ?></span>
                                </div>
                                <p class="comment__content wysiwyg">
                                    <?= $comment->comment_content; ?>
                                </p>
                            </div>
                        </article>
                <?php endforeach; ?>
            </section>
            <section class="addComment actu">
                <h2 class="addComment__title">
                    Poster un commentaire
                </h2>
                <form action="<?= admin_url('admin-post.php'); ?>" method="post">
                    <input type="hidden" name="action" value="post_newComment">
                    <input type="hidden" name="id" value="<?= get_the_ID(); ?>">
                    <div class="form__field">
                        <label for="comment" class="form__field__label">Commentaire&nbsp;:</label>
                        <div class="form__field__input">
                            <textarea name="comment" id="comment" required <?= $disabled ? "disabled" : ""; ?>></textarea>
                        </div>
                    </div>
                    <input type="submit" value="Poster le commentaire" class="form__submit" <?= $disabled ? "disabled" : ""; ?>>
                </form>
                <?php if ($disabled) : ?>
                    <div class="disabled">
                        <p>Vous devez être connecté pour pouvoir poster un commentaire</p>
                        <a class="disabled__connection" href="<?= the_permalink(106); ?>">Me connecter</a>
                    </div>
                <?php endif; ?>
            </section>
        </div>

        </body>
        <footer class="pageFooter actu">
        <?php endwhile;
        else : ?>
    <?php endif; ?>
    <?php get_footer(); ?>