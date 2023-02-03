function openInfo(){
    document.getElementById('info').style='display: block';
}

function closeInfo(){
    document.getElementById('info').style='display: none';
}

function fullScreen(){
    if (document.fullscreenElement) {
        document.exitFullscreen();
    } else {
        document.documentElement.requestFullscreen();
    }
}

function show_user_messages(key1, key2){
    var array = document.getElementsByClassName('message__items');
    var items = document.getElementsByClassName('user-items');

    for(let i = 0; i < array.length; ++i) if(!array.value) array[i].style.display = ('none')
    for(let i = 0; i < items.length; ++i){
        if(!items.value){
            items[i].style.background = ('white');
            items[i].style.color = ('black');
        }
    }

    document.getElementById('send_user_id').value=key2;
    document.getElementById(key1).style='display: flex;';
    document.getElementById('user-item-'+key1).style='background: black; color: white;';

    localStorage.setItem('item_id', key1);
    localStorage.setItem('form_id', key2);
}

window.onload = show_user_messages(localStorage.getItem('item_id'), localStorage.getItem('form_id'));


