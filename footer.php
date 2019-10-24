 <div class="pageFooter__clip">
    <div class="footer__nav">
        <?php wp_nav_menu(); ?>  
    </div>
    <div class="footer__newsletter">
        <h2 class="footer__newsletter__title">S'abonner à la newsletter</h2>
        <p class="footer__newsletter__content">Pour recevoir toutes les informations par e-mail n’hésiter pas vous abonnez à notre newsletter</p>
        <form action="" method="POST" class="footer__newsletter__form">
            <input type="email" name="email" class="footer__newsletter__form__input"><button class="footer__newsletter__form__button"><span class="sr-only">Rechercher</span><?php require get_template_directory().'/dist/icons/correct.svg';?></button>
        </form>
    </div>
</div>
</footer>
<script src="<?= assets('./dist/app.js'); ?>"></script>
</html>