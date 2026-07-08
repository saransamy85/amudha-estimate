/*==========================================
    AMUDHA CRM AUTH PAGE
===========================================*/

$(document).ready(function () {

    /*===========================
      Fade In Animation
    ===========================*/

    $(".auth-card").css({
        opacity: 0,
        transform: "translateY(40px)"
    });

    setTimeout(function () {

        $(".auth-card").css({
            opacity: 1,
            transform: "translateY(0)",
            transition: "all .8s ease"
        });

    }, 250);

    /*===========================
      Input Focus Effect
    ===========================*/

    $(".form-control").focus(function () {

        $(this).closest(".input-group").css({
            borderColor: "#2563eb",
            boxShadow: "0 0 0 4px rgba(37,99,235,.15)"
        });

    });

    $(".form-control").blur(function () {

        $(this).closest(".input-group").css({
            borderColor: "#e2e8f0",
            boxShadow: "none"
        });

    });

    /*===========================
      Password Toggle
    ===========================*/

    $("#togglePassword").click(function () {

        let input = $("#password");
        let icon = $(this).find("i");

        if (input.attr("type") == "password") {

            input.attr("type", "text");

            icon.removeClass("bi-eye");

            icon.addClass("bi-eye-slash");

        } else {

            input.attr("type", "password");

            icon.removeClass("bi-eye-slash");

            icon.addClass("bi-eye");

        }

    });

    /*===========================
      Confirm Password Toggle
    ===========================*/

    $("#toggleConfirmPassword").click(function () {

        let input = $("#confirmPassword");
        let icon = $(this).find("i");

        if (input.attr("type") == "password") {

            input.attr("type", "text");

            icon.removeClass("bi-eye");

            icon.addClass("bi-eye-slash");

        } else {

            input.attr("type", "password");

            icon.removeClass("bi-eye-slash");

            icon.addClass("bi-eye");

        }

    });

    /*===========================
      Register Button Animation
    ===========================*/

    $("form").submit(function () {

        let btn = $(".btn-register");

        btn.prop("disabled", true);

        btn.html(
            '<span class="spinner-border spinner-border-sm me-2"></span> Please Wait...'
        );

    });

    /*===========================
      Floating Animation
    ===========================*/

    $(".feature-item").each(function (index) {

        $(this).css({
            opacity: 0,
            transform: "translateX(-30px)"
        });

        setTimeout(() => {

            $(this).css({
                opacity: 1,
                transform: "translateX(0)",
                transition: ".6s"

            });

        }, 300 + (index * 150));

    });

    /*===========================
      Hover Effect
    ===========================*/

    $(".role-card").hover(function () {

        if (!$(this).prev(".btn-check").is(":checked")) {

            $(this).css({
                transform: "translateY(-5px)",
                transition: ".3s"
            });

        }

    }, function () {

        if (!$(this).prev(".btn-check").is(":checked")) {

            $(this).css({
                transform: "translateY(0)"
            });

        }

    });

});