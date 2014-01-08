<?php

defined('C5_EXECUTE') or die("Access Denied.");

class UloginBlockController extends BlockController {

  protected $btInterfaceWidth = 600;
  protected $btInterfaceHeight = 300;
  protected $btTable = 'btULogin';
  protected $btWrapperClass = 'ccm-ui';

  /**
   * Used for localization. If we want to localize the name/description we have to include this
   */
  public function getBlockTypeDescription() {
    return t("Модуль регистрации/логина через соцсети.");
  }

  public function getBlockTypeName() {
    return t("uLogin");
  }

  public function add() {
    $this->set('providers_array', array('facebook', 'linkedin', 'twitter', 'google'));
    $this->set('all_providers', $this->getAllProviders());
    $this->set('hidden_array', array('other'));
  }

  public function edit() {
    $this->set('providers_array', explode(',', $this->providers));
    $this->set('hidden_array', explode(',', $this->hidden));
    $this->set('all_providers', $this->getAllProviders());
  }

  public function view() {
    $act = array('small', 'panel', 'window');
    $this->set('display_type', $act[(int) $this->ctl_type]);
  }

  public function save($args) {
    $args['login_user'] = array_key_exists('login_user', $args) ? 1 : 0;
    $args['use_hidden'] = array_key_exists('use_hidden', $args) ? 1 : 0;

    $args['providers'] = array_key_exists('providers_array', $args) ? implode(',', $args['providers_array']) : 'facebook,linkedin,twitter,google';
    if (array_key_exists('hidden_array', $args)) {
      $args['hidden'] = in_array('other', $args['hidden_array']) ? 'other' : implode(',', $args['hidden_array']);
    } else {
      $args['hidden'] = '';
      $args['use_hidden'] = 0;
    }

    parent::save($args);
  }

  public function action_ulogin() {
    $jh = Loader::helper('json');

    $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
    $sinfo = $jh->decode($s, true);

    Log::addEntry(print_r($sinfo, true), 'uLogin');

    if ($this->register_user == 0) {
      $ui = $this->registerUser($sinfo);
      if($ui instanceof UserInfo) {
        $this->uploadAvatar($ui, $sinfo);
        if($this->login_user) {
          User::loginByUserID($ui->getUserID());
        }
      }
    }
  }

  private function registerUser($info) {
    $rand = md5(uniqid());
    $uname = $info['first_name'] . ' ' . $info['last_name'];
    // проверить наличие пользователя в системе
    $db = Loader::db();
    $uid = $db->GetOne('SELECT uID FROM Users WHERE `uEmail`=?', array($info['email']));

    // если его нет, то 
    if (is_null($uid)) {
      // проверим уникальность имени
      $count = 0;
      $isUnique = false;
      $username = $uname;
      while ($isUnique == false) {
        $nid = $db->GetOne('SELECT uID FROM Users WHERE `uName`=?', array($uname));
        if (is_null($nid)) {
          $isUnique = true;
        } else {
          $count++;
          $uname = $username . $count;
        }
      }

      // заполнить структуру и создать пользователя
      $uData = array(
        'uName' => $uname,
        'uPassword' => $rand,
        'uIsValidated' => 1,
        'uEmail' => $info['email'] ? $info['email'] : "{$rand}.social.registration@noemail.com"
      );

      if($ui = UserInfo::add($uData)) {
        // @todo: добавить отправку письма с паролем пользователю
      }
    } else {
      $ui = UserInfo::getByID($uid);
    }

    return $ui;
  }
  
  private function uploadAvatar($ui, $sinfo) {
    if($ui instanceof UserInfo && $sinfo['photo_big']) {
      $avatar_data = file_get_contents($sinfo['photo_big']);
      if($avatar_data !== FALSE) {
        // сформируем имя файла с путями
        $avatar_file = DIR_FILES_AVATARS . "/" . $ui->getUserID() . ".jpg";
        // если такой файл уже есть - удалим
        if(file_exists($avatar_file)) unlink ($avatar_file);
        // запишем аватар в файл
        file_put_contents($avatar_file, $avatar_data);
        $ih = Loader::helper('image');
        $ih->create($avatar_file, $avatar_file, AVATAR_WIDTH, AVATAR_HEIGHT, true);
        // скажем пользователю что аватар у него имеется
        $data['uHasAvatar'] = 1;
        $ui->update($data);
      }
    }
  }

  private function getAllProviders() {
    return array(
      'facebook' => 'Facebook',
      'linkedin' => 'LinkedIn',
      'twitter' => 'Twitter',
      'google' => 'Google',
      'vkontakte' => 'ВКонтакте',
      'odnoklassniki' => 'Одноклассники',
      'mailru' => 'Mail.ru',
      'yandex' => 'Яндекс',
      'livejournal' => 'Живой Журнал',
      'openid' => 'OpenID',
      'lastfm' => 'Last FM',
      'liveid' => 'Windows LiveID',
      'soundcloud' => 'SoundCloud',
      'steam' => 'Steam',
      'flickr' => 'Flickr',
      'vimeo' => 'Vimeo',
      'youtube' => 'YouTube',
      'webmoney' => 'Webmoney ID',
      'foursquare' => 'Forsquare',
      'tumblr' => 'tumblr',
      'googleplus' => 'Google+',
      'dudu' => 'dudu'
    );
  }

}

?>