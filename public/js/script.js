"use strict";

document.addEventListener("DOMContentLoaded", function() {
    Animadio.slider("5000");
});

var onloadCallback = function() {
    grecaptcha.render("recaptcha", {
        "sitekey" : "6Lfvha4ZAAAAAMxCpAlPOBunhJDMsHcBZcGTgS5r"
    });
};
