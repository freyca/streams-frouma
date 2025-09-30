import './bootstrap';
import './jquery-3.6.4.min.js';
import './video.min.js';

window.onload = function () {
    setCookieScreenSize();
};

function setCookieScreenSize() {
    if (cookieIsset('screen_size')) {
        return;
    }

    document.cookie = "screen_size=" + $(window).width() + "x" + $(window).height();
}

function cookieIsset(name) {
    var cookies = document.cookie.split(";");

    for (var i in cookies) {
        if (cookies[i].indexOf(name + "=") == 0)
            return true;
    }

    return false;
}