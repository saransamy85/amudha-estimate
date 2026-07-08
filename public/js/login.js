/* ===========================================
   AMUDHA CRM LOGIN
   login.js
=========================================== */

$(document).ready(function () {

    /*==============================
      Fade In Animation
    ==============================*/

    $(".login-box").css({
        opacity: 0,
        transform: "translateY(30px)"
    });

    setTimeout(function () {

        $(".login-box").css({
            opacity: 1,
            transform: "translateY(0)",
            transition: "all .8s ease"
        });

    }, 200);


    /*==============================
      Input Focus Effect
    ==============================*/

    $(".form-control").on("focus", function () {

        $(this).closest(".input-group").css({
            boxShadow: "0 0 0 4px rgba(37,99,235,.18)",
            transition: ".3s"
        });

    });

    $(".form-control").on("blur", function () {

        $(this).closest(".input-group").css({
            boxShadow: "0 8px 18px rgba(0,0,0,.06)"
        });

    });


    /*==============================
      Password Toggle
    ==============================*/

    $("#togglePassword").click(function () {

        let input = $("#password");

        let icon = $(this).find("i");

        if (input.attr("type") === "password") {

            input.attr("type", "text");

            icon.removeClass("bi-eye");

            icon.addClass("bi-eye-slash");

        } else {

            input.attr("type", "password");

            icon.removeClass("bi-eye-slash");

            icon.addClass("bi-eye");

        }

    });


    /*==============================
      Button Loading Animation
    ==============================*/

    $("form").submit(function () {

        let btn = $(".btn-login");

        btn.prop("disabled", true);

        btn.html(
            '<span class="spinner-border spinner-border-sm me-2"></span> Signing In...'
        );

    });


    /*==============================
      Enter Key Support
    ==============================*/

    $(".form-control").keypress(function (e) {

        if (e.which === 13) {

            $("form").submit();

        }

    });


    /*==============================
      Floating Card Animation
    ==============================*/

    $(".floating-card").each(function (index) {

        $(this).css({
            opacity: 0,
            transform: "translateY(40px)"
        });

        setTimeout(() => {

            $(this).css({
                opacity: 1,
                transform: "translateY(0)",
                transition: "all .8s ease"
            });

        }, 400 + (index * 300));

    });


});