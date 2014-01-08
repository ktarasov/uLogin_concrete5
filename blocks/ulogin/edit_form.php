<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<style media="screen">
  .provider-checkbox-title { padding-left: 20px; background: url(<?php echo $this->getBlockURL(); ?>/images/icons.png) left top no-repeat; }
  .provider-checkbox-title.vkontakte { background-position: 0 -19px }
  .provider-checkbox-title.odnoklassniki { background-position: 0 -42px }
  .provider-checkbox-title.mailru { background-position: 0 -65px }
  .provider-checkbox-title.facebook { background-position: 0 -88px }
  .provider-checkbox-title.twitter { background-position: 0 -111px }
  .provider-checkbox-title.google { background-position: 0 -134px }
  .provider-checkbox-title.yandex { background-position: 0 -157px }
  .provider-checkbox-title.livejournal { background-position: 0 -180px }
  .provider-checkbox-title.openid { background-position: 0 -203px }
  .provider-checkbox-title.flickr { background-position: 0 -249px }
  .provider-checkbox-title.lastfm { background-position: 0 -272px }
  .provider-checkbox-title.linkedin { background-position: 0 -295px }
  .provider-checkbox-title.liveid { background-position: 0 -318px }
  .provider-checkbox-title.soundcloud { background-position: 0 -341px }
  .provider-checkbox-title.steam { background-position: 0 -364px }
  .provider-checkbox-title.vimeo { background-position: 0 -387px }
  .provider-checkbox-title.webmoney { background-position: 0 -410px }
  .provider-checkbox-title.youtube { background-position: 0 -433px }
  .provider-checkbox-title.foursquare { background-position: 0 -456px }
  .provider-checkbox-title.tumblr { background-position: 0 -479px }
  .provider-checkbox-title.googleplus { background-position: 0 -502px }
  .provider-checkbox-title.dudu { background-position: 0 -525px }
</style>

<ul id="ccm-ulogin-tabs" class="nav nav-tabs">
	<li class="active"><a id="ccm-ulogin-tab-add" href="javascript:void(0);"><?php echo t('Edit')?></a></li>
	<li class=""><a id="ccm-ulogin-tab-default"  href="javascript:void(0);"><?php echo t('Видимые')?></a></li>
	<li class=""><a id="ccm-ulogin-tab-other"  href="javascript:void(0);"><?php echo t('Дополнительные')?></a></li>
</ul>

<div class="ccm-uloginPane form-horizontal" id="ccm-uloginPane-add">
  <div class="control-group">
    <label class="control-label">Тип элемента</label>
    <div class="controls">
      <label class="radio">
        <input type="radio" name="ctl_type" id="ctl_type0" value="0"<?php if($ctl_type == 0) echo " checked"; ?>> Маленькие значки
      </label>
      <label class="radio">
        <input type="radio" name="ctl_type" id="ctl_type1" value="1"<?php if($ctl_type == 1) echo " checked"; ?>> Большие значки
      </label>
      <label class="radio">
        <input type="radio" name="ctl_type" id="ctl_type2" value="2"<?php if($ctl_type == 2) echo " checked"; ?>> Панель      
      </label>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label">Регистрация</label>
    <div class="controls">
      <label class="radio">
        <input type="radio" name="register_user" class="register_user" id="register_user0" value="0"<?php if($register_user == 0) echo " checked"; ?>> Регистрировать нового пользователя если отсутствует в списке
      </label>
      <label class="radio">
        <input type="radio" name="register_user" class="register_user" id="register_user1" value="1"<?php if($register_user == 1) echo " checked"; ?>> Не регистрировать, а только заполнить поля формы регистрации
      </label>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label"> </label>
    <div class="controls">
      <label class="checkbox" id="login_user_label">
        <input type="checkbox" name="login_user" value="1"<?php if($login_user == 1) echo " checked"; ?>> Выполнять вход на сайт
      </label>
      <label class="checkbox">
        <input type="checkbox" name="use_hidden" id="use_hidden" value="1"<?php if($use_hidden == 1) echo " checked"; ?>> Использовать дополнительный список методов входа/регистрации
      </label>
    </div>
  </div>
</div>

<div class="ccm-uloginPane form-horizontal" id="ccm-uloginPane-default" style="display: none">
<?php foreach($all_providers as $pkey => $provider) { ?>
  <label class="checkbox span2">
    <input type="checkbox" class="provider_checkbox <?php echo $pkey; ?>" name="providers_array[]" value="<?php echo $pkey; ?>"<?php echo in_array($pkey, $providers_array) ? ' checked' : '' ?>> 
    <span class="provider-checkbox-title <?php echo $pkey; ?>"><?php echo $provider; ?></span>
  </label>
<?php } // end foreach ?>
</div>

<div class="ccm-uloginPane form-horizontal" id="ccm-uloginPane-other" style="display: none">
  <label class="checkbox span2">
    <input type="checkbox" id="hidden_check_all" name="hidden_array[]" value="other"<?php echo in_array('other', $hidden_array) ? ' checked' : '' ?>> (все)
  </label>
<?php foreach($all_providers as $pkey => $provider) { ?>
  <label class="checkbox span2 <?php echo $pkey; ?>">
    <input type="checkbox" class="provider_checkbox hidden-check" name="hidden_array[]" value="<?php echo $pkey; ?>"<?php echo (in_array($pkey, $hidden_array) || in_array('other', $hidden_array)) ? ' checked' : '' ?>> 
    <span class="provider-checkbox-title <?php echo $pkey; ?>"><?php echo $provider; ?></span>
  </label>
<?php } // end foreach ?>
</div>
