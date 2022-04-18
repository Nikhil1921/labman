"use strict";

const base_url = $('input[name="base_url"]').val();

function formatText (icon) {
    return $('<span><i class="fas ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
};

function bs_input_file() {
    $(".input-file").before(
        function() {
            if ( ! $(this).prev().hasClass('input-ghost') ) {
                let element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0' />");
                element.attr("name", $(this).attr("name"));
                element.change(function(){
                    element.next(element).find('input').val((element.val()).split('\\').pop());
                });
                $(this).find("button.btn-choose").click(function(){
                    element.click();
                });
                $(this).find('input').css("cursor","pointer");
                $(this).find('input').mousedown(function() {
                    $(this).parents('.input-file').prev().click();
                    return false;
                });
                return element;
            }
        }
    );
}

bs_input_file();

$(document).ready(function () {

    $(".select2-icon").select2({
        width: "100%",
        templateSelection: formatText,
        templateResult: formatText,
    });
    
    if ($("#owl-carousel-slider").length > 0) {
        $("#owl-carousel-slider").owlCarousel({
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            navigation: true,
            navigationText: ['', ''],
            transitionStyle: 'fade',
            autoPlay: 4500
        });
    }
    
    if ($('.i-check').length > 0) {
        $(".i-check, .i-radio").iCheck({
            checkboxClass: "i-check",
            radioClass: "i-radio",
        });
    }

    if ($('.package-slider').length > 0) {
        $(".package-slider").owlCarousel({
            loop: true,
            margin: 10,
            items: 4,
            responsiveClass: true,
            responsive: {
                0: {
                items: 1,
                nav: true,
                },
                600: {
                items: 1,
                nav: true,
                },
                1000: {
                items: 4,
                nav: true,
                loop: false,
                },
            },
        });
    }

    if ($('.category-slider').length > 0) {
        $(".category-slider").owlCarousel({
            loop: true,
            margin: 10,
            items: 5,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            nav: true,
            dots: false,
            responsiveClass: true,
            responsive: {
                0: {
                items: 1,
                },
                600: {
                items: 1,
                },
                1000: {
                items: 4,
                },
            },
        });
    }

    if ($('.lab-partner-slider').length > 0) {
        $(".lab-partner-slider").owlCarousel({
            loop: true,
            margin: 10,
            items: 4,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            nav: true,
            dots: false,
            responsiveClass: true,
            responsive: {
                0: {
                items: 1,
                },
                600: {
                items: 1,
                },
                1000: {
                items: 4,
                },
            },
        });
    }
    
    $("html").niceScroll({
        cursorcolor: "#000000",
        cursorborder: "0px solid #FFFFFF",
        railpadding: {
            top: 0,
            right: 0,
            left: 0,
            bottom: 0,
        },
        cursorwidth: "10px",
        cursorborderradius: "0px",
        cursoropacitymin: 0.2,
        cursoropacitymax: 0.8,
        boxzoom: true,
        horizrailenabled: false,
        zindex: 9999,
    });

    if ($("input[name=form_validate]").length > 0) {
        $.validator.addMethod(
            "chars_space",
            function (val) {
                return /^[a-zA-Z\s]*$/.test(val);
            },
            "Given input is invalid."
        );
    }

    if ($('#upload-prescription').length > 0) {
        $("#upload-prescription").submit(function(e){
            e.preventDefault();
            $("input[name=is_login]");
            if ($("input[name=is_login]").val() == true) {
                submitForm(document.getElementById("upload-prescription"));
            }else{
                toast("Login to upload prescription.");
            }
        });
    }

    if ($(".validate-form").length > 0){
        $(".validate-form").validate({
            ignore: '.ignore',
            rules: {
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                },
                email: {
                    required: true,
                    minlength: 10,
                    maxlength: 100,
                    email: true
                },
                name: {
                    required: true,
                    chars_space: true,
                    minlength: 5,
                    maxlength: 100
                },
                message: {
                    required: true,
                    chars_space: true,
                    maxlength: 255
                }
            },
            errorPlacement: function(error, element) {},
            submitHandler: function (form) {
                submitForm(form);
            },
        });
    }

    if ($(".institutional-form").length > 0){
        $(".institutional-form").validate({
            ignore: '.ignore',
            rules: {
                c_name: {
                    required: true,
                    chars_space: true,
                    minlength: 5,
                    maxlength: 255
                },
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                },
                total: {
                    required: true,
                    maxlength: 5,
                    digits: true
                },
                email: {
                    required: true,
                    minlength: 10,
                    maxlength: 100,
                    email: true
                },
                name: {
                    required: true,
                    chars_space: true,
                    minlength: 5,
                    maxlength: 100
                },
                address: {
                    required: true,
                    minlength: 5,
                    maxlength: 255
                },
                requirement: {
                    required: true,
                    chars_space: true,
                    maxlength: 255
                }
            },
            errorPlacement: function(error, element) {},
            submitHandler: function (form) {
                submitForm(form);
            },
        });
    }

    if ($(".callback-form").length > 0){
        $(".callback-form").validate({
            ignore: '.ignore',
            rules: {
                mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true
                },
                email: {
                    required: true,
                    minlength: 10,
                    maxlength: 100,
                    email: true
                },
                name: {
                    required: true,
                    chars_space: true,
                    minlength: 5,
                    maxlength: 100
                }
            },
            errorPlacement: function(error, element) {},
            submitHandler: function (form) {
                submitForm(form);
            },
        });
    }

    $(".side-bar-open").click(function () {
        $(".right-side-bar").css({
            right: "0px",
        });
    });

    $(".side-menu-close").click(function () {
        $(".right-side-bar").css({
            right: "-450px",
        });
    });

    $("#search-tests").submit(function(e){
        e.preventDefault();
        console.log($(this).serialize());
    });

    if($('[data-fancybox="images"]').length > 0){
        $('[data-fancybox="images"]').fancybox();
    }

    const cookieValue = decodeURIComponent(document.cookie);
    const str1 = cookieValue;
    const str2 = "popup";
    
    if (str1.indexOf(str2) === -1) {
        $(".side-bar-open").trigger("click");
        const d = new Date();
        d.setTime(d.getTime() + 86400 * 30);
        const expires = "expires=" + d.toUTCString();
        document.cookie = "popup" + "=" + "open" + ";" + expires;
    }
});

const submitForm = (form) => {
    $.ajax({
        url: $(form).attr("action"),
        type: "POST",
        data: new FormData(form),
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        beforeSend: function () {
            $(form).find(":submit").attr("disabled", true);
        },
        success: function (result) {
            toast(result.message);
            $(form).find(":submit").attr("disabled", false);
            if (result.error === false) form.reset();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $(form).find(":submit").attr("disabled", false);
            toast("Something is not going good.");
        },
    });
};

const toast = (msg) => {
    $(".toast").stop().html(msg).fadeIn(400).delay(3000).fadeOut(500);
};

$.ajax({
    url: `${base_url}getTests`,
    success: function (tests) {
        $("#tests-list").html(tests);
        $(".js-example-placeholder-multiple").select2({
            placeholder: "Select Test Here....",
        });
    },
});