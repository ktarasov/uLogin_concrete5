<?php

defined('C5_EXECUTE') or die(_("Access Denied."));

class UloginPackage extends Package {

  protected $pkgHandle = 'uLogin';
  protected $appVersionRequired = '5.6';
  protected $pkgVersion = '0.9.0';

  public function getPackageDescription() {
    return t("Пакет содержит весь функционал регистрации и входа на сайт через социальные сети с использованием сервиса uLogin");
  }

  public function getPackageName() {
    return t("uLogin");
  }

  public function install() {
    $pkg = parent::install();
    BlockType::installBlockTypeFromPackage("ulogin", $pkg);
  }

}
