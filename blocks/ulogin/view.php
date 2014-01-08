<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<script src="//ulogin.ru/js/ulogin.js"></script>
<?php if($ctl_type < 2) { ?>
<div id="uLogin" data-ulogin="display=<?php echo $display_type; ?><?php echo $register_user == 1 ? ';callback=ulogin_fillfields' : '' ?>;fields=first_name,photo_big<?php echo $register_user == 1 ? ';optional=' : ',' ?>last_name,email;providers=<?php echo $providers; ?>;<?php echo $use_hidden ? 'hidden='.$hidden.';' : ''; ?>redirect_uri=<?php echo $register_user == 0 ? urlencode(BASE_URL . html_entity_decode($this->action('ulogin'))) : ''; ?>"></div>
<?php } else { ?>
<a href="#" id="uLogin" data-ulogin="display=window<?php echo $register_user == 1 ? ';callback=ulogin_fillfields' : '' ?>;fields=first_name,photo_big<?php echo $register_user == 1 ? ';optional=' : ',' ?>last_name,email;redirect_uri=<?php echo $register_user == 0 ? urlencode(BASE_URL . html_entity_decode($this->action('ulogin'))) : ''; ?>"><img src="http://ulogin.ru/img/button.png" width=187 height=30 alt="МультиВход"/></a>
<?php } ?>
