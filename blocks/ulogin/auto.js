  uloginRegChangeHandler = function() {
    $('#ccm-uloginPane-add .register_user').each(function(num, el) {
      $(el).change(function(e) {
        if(this.checked && this.value == '0') {
          $('#login_user_label').css('display','block');
        } else {
          $('#login_user_label').hide();
        }
      });
    });
    
    if($('#ccm-uloginPane-add #register_user1')[0].checked) $('#login_user_label').hide();
  }
  
  uloginSetUseOtherHandler = function() {
    $('#use_hidden').change(function(e) {
      if(this.checked) {
        $('#ccm-ulogin-tab-other').css('display','block');
      } else {
        $('#ccm-ulogin-tab-other').hide();
      }
    });
  }
  
  uloginHideSelectedBox = function() {
    $('#ccm-uloginPane-default .provider_checkbox').each(function(num, el) {
      var el_other_label = $('#ccm-uloginPane-other label.' + $(el).val());
      var el_other_chk = $('#ccm-uloginPane-other label.' + $(el).val() + ' .provider_checkbox');
      if(el.checked) {
        el_other_label.hide();
        el_other_chk.hide();
        el_other_chk.removeAttr('checked');
      } else {
        el_other_label.css('display','block');
        el_other_chk.css('display','block');
      }
    });
  }
  
  uloginSetAllChecks = function() {
    $('#hidden_check_all').change(function(e) {
      var check_status = this.checked;
      $('#ccm-uloginPane-other .provider_checkbox').each(function(num, el) {
        if($(el).css('display') != 'none') {
          el.checked = check_status;
        } else {
          el.checked = false;
        }
      }); 
    });
  }
  
  uloginSetOtherChange = function() {
    $('#ccm-uloginPane-other .provider_checkbox').each(function(num, el) { 
      $(el).change(function(e) { 
        debugger;
        var all_el = $('#hidden_check_all')[0];
        if(this.checked) {
          var allchk = true;
          $('#ccm-uloginPane-other .provider_checkbox').each(function(num, el) {
            if($(el).css('display') != 'none') {
              allchk = (allchk && el.checked);
            }            
          });
          all_el.checked = allchk;
        } else {
          all_el.checked = false;
        }
      }); 
    }); 
  }

	uloginTabSetup = function() {
		$('ul#ccm-ulogin-tabs li a').each( function(num,el){ 
			el.onclick=function(){
				var pane=this.id.replace('ccm-ulogin-tab-','');
				uloginShowPane(pane);
			}
		});
    
    if(!$('#use_hidden')[0].checked) $('#ccm-ulogin-tab-other').hide();
	}
	
	uloginShowPane = function (pane){
		$('ul#ccm-ulogin-tabs li').each(function(num,el){ $(el).removeClass('active') });
		$(document.getElementById('ccm-ulogin-tab-'+pane).parentNode).addClass('active');
		$('div.ccm-uloginPane').each(function(num,el){ el.style.display='none'; });
		$('#ccm-uloginPane-'+pane).css('display','block');
    if(pane == 'other') uloginHideSelectedBox();
	}
	
	$(function() {	
		uloginTabSetup();
    uloginSetAllChecks();
    uloginSetOtherChange();
    uloginSetUseOtherHandler();
    uloginRegChangeHandler();
	});

