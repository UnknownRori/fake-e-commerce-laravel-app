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
    const target = document.getElementById(id);
    let i = 0;
    interval = setInterval(function () {
        target.innerHTML += content.charAt(i);
        i++;
        if(i > content.length) {
            clearInterval(interval);
        }
    }, time);
}
