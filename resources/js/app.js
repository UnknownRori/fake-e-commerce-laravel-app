require('./bootstrap');

$(() => {
    printcharbychar('company_introduction', "Fake E-Commerce Web Application", 100);

    hiddenobject();

    hideMessage();
});

let hiddenobject = () => {
    $(window).scroll(function () {
        hScroll = $(this).scrollTop();
        if (hScroll > 325) {
            let state = 1;
            interval = setInterval(() => {
                try {
                    $('#' + state.toString()).removeClass('hidden');
                } catch {
                    console.error("Cannot Display the hidden object");
                    clearInterval(interval);
                }
                state++;

                if (state > 10) {
                    clearInterval(interval);
                }
            }, 50);
        }else {
            let state = 1;
            interval = setInterval(() => {
                try {
                    $('#' + state.toString()).addClass('hidden');
                } catch {
                    console.error("Cannot Display the hidden object");
                    clearInterval(interval);
                }
                state++;

                if (state > 10) {
                    clearInterval(interval);
                }
            }, 50);
        }
    })
}

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
            document.getElementById(id).innerHTML += content.charAt(i);
        } catch {
            clearInterval(interval);
        }

        i++;
        if (i > content.length) {
            clearInterval(interval);
        }
    }, time);
}
