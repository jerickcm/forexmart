(function($){jQuery.expr[':'].Contains=function(a,i,m){return(a.textContent||a.innerText||"").toUpperCase().indexOf(m[3].toUpperCase())>=0;};function listFilter(header,list){var form=$("<form>").attr({"class":"filterformset","action":"#"}),input=$("<input>").attr({"id":"mysearchfieldt","class":"form-control hidden-search-form-control round-0 filterinput","type":"text","placeholder":"Search..."});$(form).append(input).appendTo(header);$(input).change(function(){var filter=$(this).val();if(filter){$(list).find("a:not(:Contains("+filter+"))").parent().slideUp();$(list).find("a:Contains("+filter+")").parent().slideDown();}else{$(list).find("li").slideDown();}return false;}).keyup(function(){if(!$("#mysearchfieldt").val().length==0){$(".searchscope").css('display','none');$("#searchloc").css('display','block');}else{$(".searchscope").css('display','block');$("#searchloc").css('display','none');}$(this).change();}).focus(function(){$(this).change();});}$(function(){listFilter($("#searchtop"),$(".list"));});}(jQuery));