<div class="pageFooter__clip">
    <div class="container">
        <div class="footer__nav">
            <?php wp_nav_menu(); ?>
        </div>
        <div class="footer__newsletter">
            <h2 class="footer__newsletter__title">S'abonner à la newsletter</h2>
            <p class="footer__newsletter__content">Pour recevoir toutes les informations par e-mail n’hésiter pas vous abonnez à notre newsletter</p>
            <form action="<?= admin_url('admin-post.php'); ?>" method="POST" class="footer__newsletter__form">
                <input type="hidden" name="action" value="post_newsletter">
                <input type="email" name="email" class="footer__newsletter__form__input"><button class="footer__newsletter__form__button"><span class="sr-only">Rechercher</span>

                </button>
            </form>
        </div>
    </div>
</div>
</footer>
<?php wp_footer(); ?>
<script src="<?= assets('./dist/app.js'); ?>"></script>

</html>