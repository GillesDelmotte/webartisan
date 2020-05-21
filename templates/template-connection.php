<?php /*Template name: page de connexion*/ ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?= get_field("meta__description"); ?>">
    <meta name="keywords" content="<?= get_field("meta__keywords"); ?>">
    <link rel="stylesheet" href="<?= assets('./dist/app.css'); ?>">
    <title><?php the_title(); ?> - Webartisan</title>
</head>

<body class="connection">
    <div class="wrapper">
        <header class="header--connection">
            <a class="header__logo" href="<?= get_home_url(); ?>">
                <?php $logo = get_field('logo__dark', 'options'); ?>
                <?= wp_get_attachment_image($logo, "full"); ?>
            </a>
        </header>
        <section class="forms container">
            <div>
                <h1 class="forms__title">Connexion</h1>
                <?php if($_SESSION['connection_error']): ?>
                    <div class="error--connection"> <?= $_SESSION['connection_error']; ?></div>
                <?php endif; ?>
                <form action="<?= admin_url('admin-post.php'); ?>" method="POST" class="js-form-login">
                    <input type="hidden" name="action" value="post_login">
                    <div class="form__field">
                        <label for="nameConnection" class="form__field__label">Nom d'utilisateur&nbsp;:</label>
                        <div class="form__field__input">
                            <input type="text" id="nameConnection" name="name" placeholder="Jean Charles">
                        </div>
                    </div>
                    <div class="form__field">
                        <i class="showPassword showPassword--login"></i>
                        <label for="passwordConnection" class="form__field__label">Mot de passe&nbsp;:</label>
                        <div class="form__field__input">
                            <input type="password" id="passwordConnection" name="password" placeholder="Minimum 8 caractères">
                        </div>
                        
                    </div>
                    <div class="form__action">
                        <button type="submit" name="submit" class="form__action__submit">Connexion</button>
                        <a href="" class="form__action__forgot links">Mot de passe oublié</a>
                    </div>
                    <?php wp_nonce_field('ajax-login-nonce', 'securityConnection'); ?>
                </form>
            </div>
            <div>
                <h1 class="forms__title">Inscription</h1>
                <form action="<?= admin_url('admin-post.php'); ?>" method="POST">
                    <input type="hidden" name="action" value="post_register">
                    <div class="form__field">
                        <label for="emailInscription" class="form__field__label">Email&nbsp;:</label>
                        <div class="form__field__input">
                            <input type="email" id="emailInscription" name="email" placeholder="jean.charles@gmail.com">
                        </div>
                        <?php if($_SESSION['email']): ?>
                            <div class="error"> <?= $_SESSION['email']; ?></div>
                        <?php endif; ?>
                        <?php if($_SESSION['email_invalid']): ?>
                            <div class="error"> <?= $_SESSION['email_invalid']; ?></div>
                        <?php endif; ?>

                    </div>
                    <div class="form__field">
                        <label for="nameInscription" class="form__field__label">Nom d'utilisateur&nbsp;:</label>
                        <div class="form__field__input">
                            <input type="text" id="nameInscription" name="name" placeholder="Jean Charles">
                        </div>
                        <?php if($_SESSION['username']): ?>
                            <div class="error"> <?= $_SESSION['username']; ?></div>
                        <?php endif; ?>
                        <?php if($_SESSION['username_length']): ?>
                            <div class="error"> <?= $_SESSION['username_length']; ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form__field">
                        <i class="showPassword showPassword--register"></i>
                        <label for="passwordInscription" class="form__field__label">Mot de passe&nbsp;:</label>
                        <div class="form__field__input">
                            <input type="password" id="passwordInscription" name="password" placeholder="Minimum 8 caractères">
                        </div>
                        <?php if($_SESSION['confirmPassword']): ?>
                            <div class="error"> <?= $_SESSION['confirmPassword']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="form__field">
                        <label for="passwordConfirm" class="form__field__label">Confirmation du mot de passe&nbsp;:</label>
                        <div class="form__field__input">
                            <input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Minimum 8 caractères">
                        </div>
                    </div>
                    <div class="form__action">
                        <button type="submit" name="submit" class="form__action__submit">Inscription</button>
                    </div>
                </form>
            </div>
        </section>
        <div class="push"></div>
    </div>
    <footer class="pageFooter connexion">
        <?php get_footer(); ?>