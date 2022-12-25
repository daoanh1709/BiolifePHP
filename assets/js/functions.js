;
(function ($) {
    'use strict';
    let $document = $(document),
            $body = $('body'),
            $window = $(window),
            $biolife_slide = $('.biolife-carousel'),
            $scroll_items = $('.biolife-cart-info .minicart-block ul.products'),
            $vertical_menu = $('#header .vertical-category-block:not(.always)'),
            $menu_mobile = $('.clone-main-menu'),
            $sticky_object = $('.biolife-sticky-object'),
            $shop_filter = $('#top-functions-area'),
            $biolife_select = $('select:not(.hidden)'),
            $rating_form = $('.comment-form-rating'),
            $accodition = $('.biolife-accodition'),
            $block_tab = $('.biolife-tab-contain'),
            $biolife_countdown = $('.biolife-countdown:not(.on_testing_mode)'),
            $biolife_popup = $('.biolife-popup'),
            $pre_loader = $('#biof-loading'),
            $btn_scroll_top = $('.btn-scroll-top'),
            $biolife_stretch_the_right_background = $('.biolife-stretch-the-right-background');

    /*Create Mobile Menu*/
    if ($menu_mobile.length) {
        $menu_mobile.biolife_menu_mobile();
    }

    /*Register Quickview Box*/
    if ($('#biolife-quickview-block').length) {
        $document.on('click', '.btn_call_quickview', function (e) {
            e.preventDefault();
            $('body').trigger('open-overlay', ['open-quickview-block']);
            $('#biolife-quickview-block-popup').modal('show');
        })
    }

    /*Register Select Element*/
    if ($biolife_select.length) {
        $biolife_select.niceSelect()
    }

    /*Minicart Scroll handle*/
    if ($scroll_items.length) {
        $scroll_items.niceScroll();
    }

    /*Carousel Handle*/
    if ($biolife_slide.length) {
        $biolife_slide.biolife_init_carousel();
    }

    /*Vertical Menu Handle*/
    if ($vertical_menu.length) {
        $vertical_menu.biolife_vertical_menu();
    }

    /*Toggle shop filter on mobile*/
    if ($shop_filter.length) {
        $shop_filter.on('click', 'a.icon-for-mobile', function (e) {
            e.preventDefault();
            $body.trigger('open-overlay', ['top-refine-opened']);
        });
    }

    /*Header Sticky*/
    if ($sticky_object.length) {
        $sticky_object.biolife_sticky_header();
    }

    /*Tab button*/
    if ($block_tab.length) {
        $block_tab.biolife_tab();
    }

    /*Rating on single product*/
    if ($rating_form.length) {
        $rating_form.biolife_rating_form_handle();
    }

    /*Accodition menu*/
    if ($accodition.length) {
        $accodition.biolife_accodition_handle();
    }

    /*Countdown*/
    if ($biolife_countdown.length) {
        $biolife_countdown.biolife_countdown();
    }

    /*stretch right background*/
    if ($biolife_stretch_the_right_background.length) {
        $biolife_stretch_the_right_background.biolife_stretch_the_right_background();
        window.onresize = function (event) {
            event.preventDefault();
            $biolife_stretch_the_right_background.biolife_stretch_the_right_background();
        };
    }

    /*Popup*/
    if ($biolife_popup.length) {
        $biolife_popup.modal('show');
    }

    /*Scroll to top*/
    if ($btn_scroll_top.length) {
        $window.on('scroll', function () {
            if ($window.scrollTop() >= 800) {
                $btn_scroll_top.addClass('showUp');
            } else {
                $btn_scroll_top.removeClass('showUp');
            }
        });
        $btn_scroll_top.on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 1500);
        });
    }

    /*Events On Document*/
    $document.on('click', '.minicart-item .action .edit', function (e) {
        e.preventDefault();
        let $this = $(this),
                cart_item = $this.closest('.minicart-item'),
                input_field = cart_item.find('.input-qty'),
                curent_val = input_field.val();
        if (!cart_item.hasClass('editing')) {
            cart_item.addClass('editing');
            input_field.removeAttr('disabled').val('');
            input_field.val(curent_val).focus();
        } else {
            cart_item.removeClass('editing');
            input_field.attr('disabled', 'disabled');
        }
    });

    $document.on('click', '.cart_item .action .remove', function (e) {
        let _this = $(this),
                cart_item = _this.closest('tr'),
                block_cart = _this.closest('.shop_table');
        cart_item.remove();
        $('body').trigger('update-minicart', [block_cart]);
    });

    $document.on('click', '.cart_item .wrap-btn-control .remove', function (e) {
        let _this = $(this),
                cart_item = _this.closest('tr'),
                block_cart = _this.closest('.shop_table');
        cart_item.remove();
        $('body').trigger('update-minicart', [block_cart]);
    });

    $document.on('click', '#overlay', function (e) {
        e.preventDefault();
        let _this = $(this),
                current_class = _this.attr('data-object'),
                class_list = 'open-overlay';
        if (typeof current_class !== "undefined" && current_class !== '') {
            class_list += ' ' + current_class;
            _this.attr('data-object', '');
        }
        $('body').removeClass(class_list);
    });

    $document.on('click', '.mobile-search .btn-close', function (e) {
        e.preventDefault();
        $('body').removeClass('open-overlay open-mobile-search');
    });

    $document.on('click', '.mobile-search .open-searchbox, .dsktp-open-searchbox', function (e) {
        e.preventDefault();
        $body.trigger('open-overlay', ['open-mobile-search']);
    });

    $document.on('click', '.mobile-footer .btn-toggle, .mobile-menu-toggle .btn-toggle', function (e) {
        e.preventDefault();
        let class_name = $(this).attr('data-object');
        if (typeof class_name !== "undefined") {
            $body.trigger('open-overlay', [class_name]);
        }
    });

    $document.on('click', '.biolife-mobile-panels .biolife-close-btn, .biolife-panels-actions-wrap .biolife-close-btn, .btn-close-quickview', function (e) {
        e.preventDefault();
        let class_name = $(this).attr('data-object');
        if (typeof class_name !== 'undefined') {
            $body.trigger('close-overlay', [class_name]);
        }
    });

    $document.on('click', '.biolife-filter .check-list .check-link', function (e) {
        e.preventDefault();
        let this_item = $(this),
                father = this_item.parent(),
                contain = this_item.closest('ul.check-list');
        if (!contain.hasClass('multiple')) {
            father.siblings().removeClass('selected');
        }
        father.toggleClass('selected');
    });

    $document.on('click', '.biolife-filter .color-list .c-link', function (e) {
        e.preventDefault();
        let father = $(this).parent();
        father.siblings().removeClass('selected');
        father.toggleClass('selected');
    });

    $document.on('click', '.qty-input .qty-btn', function (e) {
        e.preventDefault();
        let btn = $(this),
                input = btn.siblings("input[name^='qty']");
        if (input.length) {
            let current_val = parseInt(input.val(), 10),
                    max_val = parseInt(input.data('max_value'), 10),
                    step = parseInt(input.data('step'), 10);
            if (btn.hasClass('btn-up')) {
                current_val += step;
                if (current_val <= max_val) {
                    input.val(current_val);
                }
            } else {
                current_val -= step;
                if (current_val > 0) {
                    input.val(current_val);
                }
            }
        }
    });

    /*Events On Body Target*/
    $body.on('update-minicart', function (el, block_minicart) {
        if (block_minicart.find('.cart_item').length === 0) {
            block_minicart.html('<p class="minicart-empty">No products here</p>');
        }
    });

    $body.on('open-overlay', function (e, classes) {
        let addition_classes = 'open-overlay';
        if (classes !== '') {
            addition_classes += ' ' + classes;
            $('#overlay').attr('data-object', classes);
        }
        $body.addClass(addition_classes);
    });

    $body.on('close-overlay', function (e, object) {
        let classes = 'open-overlay';
        if (object !== '') {
            classes += ' ' + object;
            $('#overlay').attr('data-object', '');
        }
        $body.removeClass(classes);
    });

    /*Create overlay Element*/
    $body.append('<div id="overlay"></div>');

    $.fn.biolife_best_equal_products();

    /*preload handle*/
    $window.on('load', function () {
        if ($pre_loader.length) {
            $pre_loader.fadeOut(800);
            setTimeout(function () {
                $pre_loader.remove();
            }, 3000);
        }
    });
})(jQuery);

function signUpFormCheck() {
    var valid = true;
    var name = document.getElementById('name');
    var name_pattern = /^\s*([A-Za-z]{1,}([\.,] |[-']| ))+[A-Za-z]+\.?\s*$/;
    var phone = document.getElementById('phone');
    var phone_pattern = /^\d{10,11}$/;
    var mail = document.getElementById('email');
    var mail_pattern = /^[a-zA-Z]\w*(\.\w+)*\@\w+(\.\w{2,3})+$/;
    var pass = document.getElementById('pass');
    var cfpass = document.getElementById('cfpassword');
    var pass_pattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    if (name.value != '' && name_pattern.test(name.value) == false) {
        alert("Name must contain only letters and whitespace");
        name.value = '';
        name.focus();
        valid = false;
    } else if (!document.getElementById('sumale').checked && !document.getElementById('sufemale').checked && !document.getElementById('suother').checked) {
        alert('Please choose Gender');
        valid = false;
    } else if (phone.value != '' && phone_pattern.test(phone.value) == false) {
        alert("Please match the requested format for Phone Number: Must be a 10 to 11 digit number");
        phone.value = '';
        phone.focus();
        valid = false;
    } else if (mail.value != '' && mail_pattern.test(mail.value) == false) {
        alert("Please match the requested format for E-Mail: info1234@gmail.com");
        mail.value = '';
        mail.focus();
        valid = false;
    } else if (pass.value != '' && pass_pattern.test(pass.value) == false) {
        alert("Password must contain at least one number, one uppercase letter, one lowercase letter, and at least 8 characters");
        pass.value = '';
        cfpass.value = '';
        pass.focus();
        valid = false;
    } else if (pass.value != cfpass.value) {
        alert("Passwords don't match");
        pass.value = '';
        cfpass.value = '';
        pass.focus();
        valid = false;
    }
    return valid;
}

function setPasswordFormCheck() {
    var valid = true;
    var pass = document.getElementById('spass');
    var cfpass = document.getElementById('scfpassword');

    var pass_pattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    if (pass.value != '' && pass_pattern.test(pass.value) == false) {
        alert("Password must contain at least one number, one uppercase letter, one lowercase letter, and at least 8 characters");
        pass.value = '';
        cfpass.value = '';
        pass.focus();
        valid = false;
    }

    if (pass.value != cfpass.value) {
        alert("Passwords don't match");
        pass.value = '';
        cfpass.value = '';
        pass.focus();
        valid = false;
    }
    
    return valid;
}

function accountinfoCheck() {
    var valid = true;
    var name = document.getElementById('info_name');
    var name_pattern = /^\s*([A-Za-z]{1,}([\.,] |[-']| ))+[A-Za-z]+\.?\s*$/;
    var mail = document.getElementById('info_email');
    var mail_pattern = /^[a-zA-Z]\w*(\.\w+)*\@\w+(\.\w{2,3})+$/;
    var phone = document.getElementById('info_phone');
    var phone_pattern = /^\d{10,11}$/;
    if (name.value != '' && name_pattern.test(name.value) == false) {
        alert("Name must contain only letters and whitespace");
        name.value = '';
        name.focus();
        valid = false;
    } else if (mail.value != '' && mail_pattern.test(mail.value) == false) {
        alert("Please match the requested format for E-Mail: info1234@gmail.com");
        mail.value = '';
        mail.focus();
        valid = false;
    } else if (phone.value != '' && phone_pattern.test(phone.value) == false) {
        alert("Please match the requested format for Phone Number: Must be a 10 to 11 digit number");
        phone.value = '';
        phone.focus();
        valid = false;
    } else if (!document.getElementById('male').checked && !document.getElementById('female').checked && !document.getElementById('other').checked) {
        alert('Please choose Gender');
        valid = false;
    }
    return valid;
}

function changePassFormCheck() {
    var valid = true;
    var cur_pass = document.getElementById('cur_pass');
    var pass_pattern = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    var new_pass = document.getElementById('new_pass');
    var cfpass = document.getElementById('cf_pass');
    if (cur_pass.value != '' && pass_pattern.test(cur_pass.value) == false) {
        alert("Password must contain at least one number, one uppercase letter, one lowercase letter, and at least 8 characters");
        cur_pass.value = '';
        cur_pass.focus();
        valid = false;
    } else if (new_pass.value != '' && pass_pattern.test(new_pass.value) == false) {
        alert("Password must contain at least one number, one uppercase letter, one lowercase letter, and at least 8 characters");
        new_pass.value = '';
        cfpass.value = '';
        new_pass.focus();
        valid = false;
    } else if (new_pass.value == cur_pass.value) {
        alert("The new password is the same as the old password");
        new_pass.value = '';
        cfpass.value = '';
        new_pass.focus();
        valid = false;
    } else if (new_pass.value != cfpass.value) {
        alert("Passwords don't match");
        new_pass.value = '';
        cfpass.value = '';
        new_pass.focus();
        valid = false;
    }
    return valid;
}

$(document).ready(function () {

    $.ajax({
        type: 'post',
        url: 'http://localhost:1000/Biolife/process/cart_process.php',
        data: {
            total_cart_items: "totalitems"
        },
        success: function (response) {
            document.getElementById("total_items").innerHTML = response;
        }
    });

});

function cart(id, price, action, quantity)
{
    if (quantity == 0) {
        quantity = document.getElementById('qty12554').value;
    }
    $.ajax({
        type: 'get',
        url: 'http://localhost:1000/Biolife/process/cart_process.php',
        data: {
            id: id,
            price: price,
            action: action,
            quantity: quantity
        },
        success: function (response) {
            if (response == "exit") {
                window.location.href = "http://localhost:1000/Biolife/login.php?from=details&id=" + id;
            } else {
                alert("The product has been added to cart successfully");
                document.getElementById("total_items").innerHTML = response;
            }
        }
    });
}

function show_cart()
{
    $.ajax({
        type: 'post',
        url: 'http://localhost:1000/Biolife/process/cart_process.php',
        data: {
            showcart: "cart"
        },
        success: function (response) {
            document.getElementById("minicart_list").innerHTML = response;
        }
    });
}

function remove_cart(id, action)
{
    $.ajax({
        type: 'get',
        url: 'http://localhost:1000/Biolife/process/cart_process.php',
        data: {
            id: id,
            action: action
        },
        success: function (response) {
            document.getElementById("total_items").innerHTML = response;
            var totalItem = document.getElementById('totalitems').innerText;
            totalItem = "(" + totalItem + " items)"
            document.getElementById("totalItem").innerHTML = totalItem;
            var totalPrice = document.getElementById('cartTotal').innerText;
            document.getElementById("totalPrice").innerHTML = totalPrice;

        }
    });
}

function clear_cart(action)
{
    $("#tblCart").find("tr").remove();
    if ($("#tblCart").find('.cart_item').length === 0) {
        $("#tblCart").html('<p class="minicart-empty">No products here</p>');
    }
    $.ajax({
        type: 'get',
        url: 'http://localhost:1000/Biolife/process/cart_process.php',
        data: {
            action: action
        },
        success: function (response) {
            document.getElementById("total_items").innerHTML = response;
        }
    });

}

$(function () {
    $('#btnUpload').click(function () {
        $('#fileToUpload').click();
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imageInfo').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function notify(mess) {
    alert(mess);
}

function from(from) {
    $.ajax({
        type: 'post',
        url: 'http://localhost:1000/Biolife/process/login.php',
        data: {
            from: from
        },
        success: function (response) {

        }
    });
}

//function quick_view(id)
//{
//    $.ajax({
//        type: 'get',
//        url: 'http://localhost:1000/Biolife/process/cart_process.php',
//        data: {
//            id: id,
//            action: "quickview"
//        },
//        success: function (response) {
//            alert(response);
//            document.getElementById("biolife-quickview-block").innerHTML = response;
//        }
//    });
//}

function update_cart(id, el, change, price)
{
    quantity = $(el).parents('.qty-input').find('input.quantity-input').val();
    if (change == "up") {
        quantity = parseInt(quantity) + 1;
    } else if (change == "down") {
        if (quantity == "1") {
            quantity = parseInt(quantity);
        } else {
            quantity = parseInt(quantity) - 1;
        }
    }

    $.ajax({
        type: 'get',
        url: 'http://localhost:1000/Biolife/process/cart_process.php',
        data: {
            id: id,
            action: "update",
            quantity: quantity
        },
        success: function (response) {
            document.getElementById("total_items").innerHTML = response;
            var totalItem = document.getElementById('totalitems').innerText;
            totalItem = "(" + totalItem + " items)"
            document.getElementById("totalItem").innerHTML = totalItem;
            var totalPrice = document.getElementById('cartTotal').innerText;
            document.getElementById("totalPrice").innerHTML = totalPrice;
            $(el).parents('.cart_item').find('span.price-total').html("$" + (price * quantity).toFixed(2));
        }
    });
}

function wishlist(id, price, action)
{
    $.ajax({
        type: 'get',
        url: 'http://localhost:1000/Biolife/process/wishlist_process.php',
        data: {
            id: id,
            price: price,
            action: action
        },
        success: function (response) {
            if (response == "exit") {
                window.location.href = "http://localhost:1000/Biolife/login.php?from=details&id=" + id;
            } else if (response == "exist") {
                alert("This product already exists in your wishlist");
            } else {
                alert("The product has been added to wishlist successfully");
                document.getElementById("total_items_wishlist").innerHTML = response;
            }
        }
    });
}

$(document).ready(function () {

    $.ajax({
        type: 'post',
        url: 'http://localhost:1000/Biolife/process/wishlist_process.php',
        data: {
            total_cart_items: "totalitems"
        },
        success: function (response) {
            document.getElementById("total_items_wishlist").innerHTML = response;
        }
    });

});

function remove_wishlist(id, action)
{
    $.ajax({
        type: 'get',
        url: 'http://localhost:1000/Biolife/process/wishlist_process.php',
        data: {
            id: id,
            action: action
        },
        success: function (response) {
            document.getElementById("total_items_wishlist").innerHTML = response;
        }
    });

}

function clear_wishlist(action)
{
    $("#tblWishlist").find("tr").remove();
    if ($("#tblWishlist").find('.cart_item').length === 0) {
        $("#tblWishlist").html('<p class="minicart-empty">No products here</p>');
    }
    $.ajax({
        type: 'get',
        url: 'http://localhost:1000/Biolife/process/wishlist_process.php',
        data: {
            action: action
        },
        success: function (response) {
            document.getElementById("total_items_wishlist").innerHTML = response;
        }
    });

}

var id;

$(document).on('click', '#edit-address', function () {
    var $row = $(this).closest('tr');
    id = $row.attr('id');
    var name = $row.find('span.add_name').text();
    document.getElementById("edit_name").value = name.trim();
    var phone = $row.find('span.add_phone').text();
    document.getElementById("edit_phone").value = phone.trim();
    var city = $row.find('span.add_city').text();
    document.getElementById("edit_city").value = city.trim();
    var detail = $row.find('span.add_detail').text();
    document.getElementById("edit_detail").value = detail.trim();
});

//$(document).on('click', '#remove-address', function () {
//    
//});

$(document).on('click', '#remove-address', function () {

    var $row = $(this).closest('tr');
    addID = $row.attr('id');
    $.ajax({
        type: 'get',
        url: 'http://localhost:1000/Biolife/process/address_process.php',
        data: {
            action: "remove",
            id: addID
        },
        success: function (response) {
            if (response == "failed") {
                alert("Delete unsuccessfully!");
            } else {
                alert("Delete successfully!");
                $('.address-info').remove();
                document.getElementById("address-table").innerHTML = response;
            }
        }
    });
});

function addAddress(id) {
    var valid = true;
    var name = document.getElementById('add_name');
    var name_pattern = /^\s*([A-Za-z]{1,}([\.,] |[-']| ))+[A-Za-z]+\.?\s*$/;
    var phone = document.getElementById('add_phone');
    var phone_pattern = /^\d{10,11}$/;
    var city = document.getElementById('add_city');
    var city_pattern = /^\s*([A-Za-z]{1,}([\.,] |[-']| ))+[A-Za-z]+\.?\s*$/;
    var address = document.getElementById('add_detail');
    var straddress = address.value;
    straddress = straddress.split(" ").join("");
    var addressChar = straddress.length;
    if (name.value == '') {
        alert("Please fill out Name field.");
        name.focus();
        valid = false;
    } else if (phone.value == '') {
        alert("Please fill out Phone field.");
        phone.focus();
        valid = false;
    } else if (city.value == '') {
        alert("Please fill out City field.");
        city.focus();
        valid = false;
    } else if (address.value.trim() == '') {
        alert("Please fill out Address field.");
        address.focus();
        valid = false;
    } else if (name.value != '' && name_pattern.test(name.value) == false) {
        alert("Name must contain only letters and whitespace");
        name.value = '';
        name.focus();
        valid = false;
    } else if (phone.value != '' && phone_pattern.test(phone.value) == false) {
        alert("Please match the requested format for Phone Number: Must be a 10 to 11 digit number");
        phone.value = '';
        phone.focus();
        valid = false;
    } else if (city.value != '' && city_pattern.test(city.value) == false) {
        alert("Name must contain only letters and whitespace");
        city.value = '';
        city.focus();
        valid = false;
    } else if (address.value != '' && addressChar < 20) {
        alert("Address must be at least 20 characters");
        address.value = '';
        address.focus();
        valid = false;
    }

    if (valid === true) {
        $('#submitAddAddress').attr("data-dismiss", "modal");

        $.ajax({
            type: 'get',
            url: 'http://localhost:1000/Biolife/process/address_process.php',
            data: {
                action: "add",
                name: name.value,
                phone: phone.value,
                city: city.value,
                address: address.value,
                id: id
            },
            success: function (response) {
                if (response == "failed") {
                    alert("Added unsuccessfully!");
                } else {
                    alert("Added successfully!");
                    $('.address-info').remove();
                    document.getElementById("address-table").innerHTML = response;
                }
            }
        });

        name.value = '';
        phone.value = '';
        city.value = '';
        address.value = '';

    }
}

function editAddress() {
    var valid = true;
    var name = document.getElementById('edit_name');
    var name_pattern = /^\s*([A-Za-z]{1,}([\.,] |[-']| ))+[A-Za-z]+\.?\s*$/;
    var phone = document.getElementById('edit_phone');
    var phone_pattern = /^\d{10,11}$/;
    var city = document.getElementById('edit_city');
    var city_pattern = /^\s*([A-Za-z]{1,}([\.,] |[-']| ))+[A-Za-z]+\.?\s*$/;
    var address = document.getElementById('edit_detail');
    var straddress = address.value;
    straddress = straddress.split(" ").join("");
    var addressChar = straddress.length;
    if (name.value == '') {
        alert("Please fill out Name field.");
        name.focus();
        valid = false;
    } else if (phone.value == '') {
        alert("Please fill out Phone field.");
        phone.focus();
        valid = false;
    } else if (city.value == '') {
        alert("Please fill out City field.");
        city.focus();
        valid = false;
    } else if (address.value.trim() == '') {
        alert("Please fill out Address field.");
        address.focus();
        valid = false;
    } else if (name.value != '' && name_pattern.test(name.value) == false) {
        alert("Name must contain only letters and whitespace");
        name.value = '';
        name.focus();
        valid = false;
    } else if (phone.value != '' && phone_pattern.test(phone.value) == false) {
        alert("Please match the requested format for Phone Number: Must be a 10 to 11 digit number");
        phone.value = '';
        phone.focus();
        valid = false;
    } else if (city.value != '' && city_pattern.test(city.value) == false) {
        alert("Name must contain only letters and whitespace");
        city.value = '';
        city.focus();
        valid = false;
    } else if (address.value != '' && addressChar < 20) {
        alert("Address must be at least 20 characters");
        address.value = '';
        address.focus();
        valid = false;
    }

    if (valid === true) {
        $('#submitEditAddress').attr("data-dismiss", "modal");

        $.ajax({
            type: 'get',
            url: 'http://localhost:1000/Biolife/process/address_process.php',
            data: {
                action: "edit",
                name: name.value,
                phone: phone.value,
                city: city.value,
                address: address.value,
                id: id
            },
            success: function (response) {
                if (response == "failed") {
                    alert("Updated unsuccessfully!");
                } else {
                    alert("Updated successfully!");
                    $('.address-info').remove();
                    document.getElementById("address-table").innerHTML = response;
                }
            }
        });
    }
}

$(document).on('click', '.chooseAddress', function () {
    $('input:radio[name="chooseAddress"]').attr('checked', false);
    $(this).attr('checked', true);
    var $row = $(this).closest('tr');
    $("button.btnCollapse").click();
    var name = $row.find('span.addressName').text();
    $("#nameAddress").html(name);
    var phone = $row.find('span.addressPhone').text();
    $("#phoneAddress").html(phone);
    var add = $row.find('span.addressAdress').text();
    $("#addressAdd").html(add);

});

function loginCheck(from, page, id, category) {
    var email = document.getElementById('email_address').value;
    var pass = document.getElementById('password').value;
    var checked;
    if ($('.checkbox1').is(':checked')) {
        checked = $('.checkbox1:checked').val();
    } else {
        checked = "";
    }

    $.ajax({
        type: 'get',
        url: 'http://localhost:1000/Biolife/process/login_process.php',
        data: {
            email: email,
            pass: pass,
            action: 'login',
            check: checked,
            from: from,
            page: page,
            id: id,
            category: category
        },
        success: function (response) {
            var fr = from;
            var pg = page;
            var idd = id;
            var cate = category;
            if (response == "Fail") {
                alert("Your Email Address or Password is incorrect. Please try again");
            } else if (response == "Success") {
                if (fr == "index") {
                    if (pg == "") {
                        window.location.href = "http://localhost:1000/Biolife/index.php";
                    } else {
                        window.location.href = "http://localhost:1000/Biolife/index.php?page=" + pg;
                    }
                } else if (fr == "details") {
                    window.location.href = "http://localhost:1000/Biolife/productdetails.php?id=" + idd;
                } else if (fr == "product") {
                    if (cate == "") {
                        window.location.href = "http://localhost:1000/Biolife/product.php";
                    } else {
                        window.location.href = "http://localhost:1000/Biolife/product.php?category=" + cate;
                    }
                }
            }
        }
    });
}

function forgotCheck() {
    var email = document.getElementById('fmail').value;
    $.ajax({
        type: 'get',
        url: "http://localhost:1000/Biolife/process/forgotpass_process.php",
        data: {
            email: email,
            action: "forgot"
        },
        success: function (response) {
            if (response == "Success") {
                alert("Check Your Email and Click on the link sent to your email");
                window.location.href = "login.php";
            } else if (response == "Fail") {
                alert("Your Email Address is incorrect, please try again");
            }

        }
    });
}

function place_order() {
    var addID = $('input[type=radio][name=chooseAddress]:checked').attr('id');
    var payment = $('input[type=radio][name=paymentradio]:checked').val();
    var note = document.getElementById('ordernote').value;
    $.ajax({
        type: 'get',
        url: "http://localhost:1000/Biolife/process/checkout_process.php",
        data: {
            action: "order",
            addid: addID,
            payment: payment,
            note: note
        },
        success: function (response) {
            if (response != "Fail") {
                window.location.href = "http://localhost:1000/Biolife/index.php?page=thankyou&orderid=" + response;
            } else {
                alert("Unsuccessful!");
            }
        }
    });
}
//
$(document).on('click', '#view-order', function () {
    var $row = $(this).closest('tr');
    var orderid = $row.find('span.order_id').text();

    $.ajax({
        type: 'get',
        url: "http://localhost:1000/Biolife/process/vieworder_process.php",
        data: {
            orderid: orderid
        },
        success: function (response) {
            document.getElementById("viewOrder").innerHTML = response;
        }
    });
});

$(document).ready(function () {

    $.ajax({
        type: 'get',
        url: "http://localhost:1000/Biolife/process/myorders_process.php",
        data: {
            action: "load"
        },
        success: function (response) {
            document.getElementById("myorders").innerHTML = response;
            $('select').niceSelect(); //apply again
        }
    });
});

var select = "";

$(document).on("click", ".nice-select .option", function () {
    s = $(this);
    select = s.data("value");
});

$(document).on("change", "#filterorder", function () {
    $.ajax({
        type: 'get',
        url: "http://localhost:1000/Biolife/process/myorders_process.php",
        data: {
            action: "filter",
            select: select
        },
        success: function (response) {
            document.getElementById("myorders").innerHTML = response;
            $('select').niceSelect();

        }
    });
});

$(document).ready(function (e) {
    $("#formInfo").on('submit', (function (e) {
        e.preventDefault();
        if (accountinfoCheck() === true) {
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "http://localhost:1000/Biolife/process/accountinfo_process.php",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert(response);
                    $("#loginIcon").load(" #loginIcon");
                    $("#acountImage").load(" #acountImage");
                },
                error: function (data) {
                    alert("Fail");
                }
            });
        }
    }));
});

$(document).ready(function (e) {
    $("#formChangePassword").on('submit', (function (e) {
        e.preventDefault();
        if (changePassFormCheck() === true) {
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "http://localhost:1000/Biolife/process/changepassword_process.php",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert(response);
                },
                error: function (data) {
                    alert("Fail");
                }
            });
            document.getElementById('cur_pass').value = "";
            document.getElementById('new_pass').value = "";
            document.getElementById('cf_pass').value = "";
        }
    }));
});

$(document).ready(function (e) {
    $("#formSignUp").on('submit', (function (e) {
        e.preventDefault();
        if (signUpFormCheck() === true) {
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "http://localhost:1000/Biolife/process/register_process.php",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "Success") {
                        alert("Sign Up Success!");
                        window.location.href = "index.php";
                    } else {
                        alert(response);
                    }
                },
                error: function (data) {
                    alert("Fail");
                }
            });
        }
    }));
});

$(document).ready(function (e) {
    $("#setPassForm").on('submit', (function (e) {
        e.preventDefault();
        if (setPasswordFormCheck() === true) {
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "http://localhost:1000/Biolife/process/setpassword_process.php",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "Success") {
                        alert("Congratulations! Your password has been updated successfully.");
                        window.location.href = "index.php";
                    } else {
                        alert("Something goes wrong. Please try again");
                        window.location.href = "index.php";
                    }
                },
                error: function (data) {
                    alert("Fail");
                }
            });
        }
    }));
});

function remove_order(id)
{
    $.ajax({
        type: 'get',
        url: 'http://localhost:1000/Biolife/process/myorders_process.php',
        data: {
            id: id,
            action: "remove",
            select: select
        },
        success: function (response) {
            document.getElementById("myorders").innerHTML = response;
            $('select').niceSelect();
        }
    });
}

function receive_order(id)
{
    $.ajax({
        type: 'get',
        url: 'http://localhost:1000/Biolife/process/myorders_process.php',
        data: {
            id: id,
            action: "receive",
            select: select
        },
        success: function (response) {
            document.getElementById("myorders").innerHTML = response;
            $('select').niceSelect();
        }
    });
}

var cate = "all";

$(document).on("click", ".nice-select .option", function () {
    s = $(this);
    cate = s.data("value");
});

function search() {
    var s = document.getElementById('searchKeyword').value;
    if (cate == "all") {
        window.location.href = "search.php?s=" + s;
    } else {
        window.location.href = "search.php?s=" + s + "&category=" + cate;
    }
}