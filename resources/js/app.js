require('./bootstrap');

$(() => {
    printcharbychar('company_introduction', "Fake E-Commerce Web Application", 100);

    hideMessage();
});

let hideMessage = () => {
    setTimeout(() => {
        try {
            $('#msg').addClass('hidden');
            document.getElementById('msg').innerText = '';
        } catch {
            console.log('There is no error message to hide');
        }
    }, 7000);
}

let printcharbychar = (id, content, time) => {
    let i = 0;
    interval = setInterval(() => {

        try {
            document.getElementById(id).innerText += content.charAt(i);
        } catch {
            clearInterval(interval);
        }

        i++;
        if (i > content.length) {
            clearInterval(interval);
        }
    }, time);
}
