<?php get_header(); ?>
<?php the_post(); ?>
<div class="pageHeader snippets">
    <div class="pageHeader__clip">
        <div class="container">
            <h1 class="pageHeader__title">
                <?= the_title(); ?>
            </h1>
        </div>
    </div>
</div>
<div class="container">
    <section class="tuto__content">
        <?php if(get_field('tuto__video')): ?>
            <div class="embed-container">
                <?php the_field('tuto__video'); ?>
            </div>
            <div class="tuto__content__desc wysiwyg">
            <?php the_content(); ?>
            </div>
        <?php else: ?>
            <div class="tuto__content__desc--bgc wysiwyg">
                <?= get_the_content(); ?>
            </div>
        <?php endif; ?>
    </section>
</div>
<div class="container">
    <section class="comments tuto">
        <h2 class="comments__title">
            Commentaires
        </h2>
        <?php $comments = get_comments('post_id='.get_the_ID()); ?>
        <?php if(!empty($comments) ):  ?>
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
        <?php else: ?>
            <div class="noSearch">
            <p>il n'y a pas de commentaire</p>
        </div> 
        <?php endif; ?>
    </section>
    <section class="addComment tuto">
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
            <input type="submit" value="Poster la réponse" class="form__submit" <?= $disabled ? "disabled" : ""; ?>>
        </form>
        <?php if ($disabled) : ?>
            <div class="disabled">
                <p>Vous devez être connecté pour pouvoir poster un commentaire</p>
                <a class="disabled__connection" href="<?= the_permalink(106); ?>">Me connecter</a>
            </div>
        <?php endif; ?>
    </section>
</div>
<footer class="pageFooter snippets">

    <?php get_footer(); ?>

    