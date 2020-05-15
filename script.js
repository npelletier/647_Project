function addtoRemoveList(ele){
    var name = ele.childNodes[0].innerHTML;
    var maxValue = ele.childNodes[1].innerHTML;
    var nameid = name.replace(/\s/g, '');

    var form = document.getElementById('remove');
    var exist = false;
    for(var i = 0; i < form.childElementCount; i++){
        if(form.childNodes[i].value == name){
            exist = true;
        }
    }
    if(!exist){
        form.insertAdjacentHTML('beforeend', "<input type='text' name='remove[]' id ='"+nameid+"' value = '"+name+"' readonly required></input><input type='number' name ='removeValue[]' value='1' name ='"+nameid+"Quantity' min='1' max='"+maxValue+"' onkeyup=enforceMinMax(this) required><br>");
    }
}

function addtoAddList(ele){
    var name = ele.childNodes[0].innerHTML;
    var nameid = name.replace(/\s/g, '');

    var form = document.getElementById('add');
    var exist = false;
    for(var i = 0; i < form.childElementCount; i++){
        if(form.childNodes[i].value == name){
            exist = true;
        }
    }
    if(!exist){
        form.insertAdjacentHTML('beforeend', "<input type='text' name='add[]' id ='"+nameid+"' value = '"+name+"' readonly required></input><input name='addValue[]' type='number' value='1' name ='"+nameid+"Quantity' min='1' onkeyup=enforceMin(this) required><br>");
    }
}

function enforceMinMax(el){
  if(el.value != ""){
    if(parseInt(el.value) < parseInt(el.min)){
      el.value = el.min;
    }
    if(parseInt(el.value) > parseInt(el.max)){
      el.value = el.max;
    }
  }
}

function enforceMin(el){
  if(el.value != ""){
    if(parseInt(el.value) < parseInt(el.min)){
      el.value = el.min;
    }
  }
}

function createCookie(value){
	console.log("Testing");
  document.cookie="charname="+value;
}

function getCookie(name){
  var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)username\s*\=\s*([^;]*).*$)|^.*$/, "$1");
  return cookieValue
}
