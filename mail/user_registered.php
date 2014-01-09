<?php
defined('C5_EXECUTE') or die("Access Denied.");
$subject = SITE . ': ' . t("Регистрация пользователя.");

/**
 * HTML BODY START
 */
ob_start();
?>
<h2><?php echo t('New User Registration') ?></h2>
<?php echo t('Вы зарегистрированы на сайте ') . SITE ?><br />
<br />
<?php echo t('User Name') ?>: <b><?php echo $uName ?></b><br />
<?php echo t('Email Address') ?>: <b><?php echo $uEmail ?></b><br />
<?php echo t('Password') ?>: <b><?php echo $uPass ?></b><br />
<br />
<?php if ($attribs): ?>
  <ul>
    <?php foreach ($attribs as $item): ?>
      <li><?php echo $item ?></li>
    <?php endforeach ?>
  </ul>
<?php endif ?>
<br />
<?php echo t('Для входа на сайт используйте следующую ссылку: ') ?><a href="<?php echo BASE_URL . '/login/' ?>"><?php echo BASE_URL . '/login/' ?></a><br />
<?php
$bodyHTML = ob_get_clean();
/**
 * HTML BODY END
 *
 * ======================
 *
 * PLAIN TEXT BODY START
 */
ob_start();
?>
<?php echo t('New User Registration') ?>

<?php echo t('Вы зарегистрированы на сайте ') . SITE ?>

<?php echo t('User Name') ?>: <?php echo $uName ?>
<?php echo t('Email Address') ?>: <?php echo $uEmail ?>
<?php echo t('Password') ?>: <?php echo $uPass ?>

<?php if ($attribs): ?>
<?php foreach ($attribs as $item): ?>
<?php echo $item ?>
<?php endforeach ?>
<?php endif ?>

<?php echo t('Для входа на сайт используйте следующую ссылку: ') . BASE_URL . '/login/' ?>

<?php
$body = ob_end_clean();
/**
* PLAIN TEXT BODY END
*/
