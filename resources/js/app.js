require('./bootstrap');

$(function() {
    printcharbychar('company_introduction', "Fake E-Commerce Web Application", 100);

    setTimeout(function (){
        try {
            $('#msg').addClass('hidden');
            document.getElementById('msg').innerText = '';
        }catch {
            console.log('There is no error message to hide');
        }
    }, 7000);
});

function printcharbychar (id, content, time) {
    let i = 0;
    interval = setInterval(function () {

        try {
            document.getElementById(id).innerHTML += content.charAt(i);
        } catch {
            clearInterval(interval);
        }

        i++;
        if(i > content.length) {
            clearInterval(interval);
        }
    }, time);
}
