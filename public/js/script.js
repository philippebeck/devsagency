"use strict";

document.addEventListener("DOMContentLoaded", function() {
    Animadio.slider();
});

var onloadCallback = function() {
    grecaptcha.render('recaptcha', {
        'sitekey' : '6Ld_2eYUAAAAAPHLRqN5mOEqZJqNKq7RO01CcwIy'
    });
};
