function ulogin_fillfields(token){
  $.getJSON("//ulogin.ru/token.php?host=" + encodeURIComponent(location.toString()) + "&token=" + token + "&callback=?", function(obj) {
    var obj = $.parseJSON(obj.toString());
    if(!obj.error) {
      if(console) console.dir(obj);
      // заполнить поля формы регистрации
    } else {
      alert('Ошибка регистрации через выбранную социальную сеть: ' + obj.error);
    }
  });
}
