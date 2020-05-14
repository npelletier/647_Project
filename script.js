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
        form.insertAdjacentHTML('beforeend', "<input type='text' id ='"+nameid+"' value = '"+name+"' readonly></input><input type='number' value='1' name ='"+nameid+"Quantity' min='1' max = '"+maxValue+"'><br>");
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
        form.insertAdjacentHTML('beforeend', "<input type='text' id ='"+nameid+"' value = '"+name+"' readonly></input><input type='number' value='1' name ='"+nameid+"Quantity' min='1'><br>");
    }
}