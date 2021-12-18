require('./bootstrap');

setTimeout(function (){
    $('#msg').addClass('hidden');
    document.getElementById('msg').innerContent = '';
}, 7000);
