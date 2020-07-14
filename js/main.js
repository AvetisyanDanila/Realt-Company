// Плавная прокрутка для ЯКОРЕЙ
$("body").on('click', '[href*="#"]', function (e) {
    var fixed_offset = 81;
    $('html,body').stop().animate({ scrollTop: $(this.hash).offset().top - fixed_offset }, 1000);
    e.preventDefault();
});
// Активный класс у меню и плавная прокрутка для ХЕДЕРА
'use strict';
const headerHeight = document.querySelector('.header').offsetHeight;

function smoothScroll(target, duration) {
    var target = document.querySelector(target);
    var targetPosition = target.getBoundingClientRect().top;
    var startPosition = window.pageYOffset;
    var distance = targetPosition - headerHeight + 1.5;
    var startTime = null;

    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        var timeElapsed = currentTime - startTime;
        var run = ease(timeElapsed, startPosition, distance, duration);
        window.scrollTo(0, run);
        if (timeElapsed < duration) requestAnimationFrame(animation);
    }

    function ease(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t + b;
        t--;
        return -c / 2 * (t * (t - 2) - 1) + b;
    }

    requestAnimationFrame(animation);
}

class NavigationMenu {
    constructor(root) {
        this.root = root;
        this.links = null;
        this.cacheNodes();
        this.bindEvents();
    }

    cacheNodes() {
        this.links = this.root.querySelectorAll('.js-page-scroll');
    }

    bindEvents() {
        document.addEventListener('click', (event) => {
            const target = event.target;

            if (target.classList.contains('js-page-scroll')) {
                event.preventDefault();
                const id = target.hash;

                smoothScroll(id, 1000);
            }
        });

        window.addEventListener("scroll", event => {
            let fromTop = window.scrollY + headerHeight;

            this.links.forEach(link => {
                let section = document.querySelector(link.hash);

                if (
                    section.offsetTop <= fromTop &&
                    section.offsetTop + section.offsetHeight > fromTop
                ) {
                    link.classList.add("menu__link_active");
                } else {
                    link.classList.remove("menu__link_active");
                }
            });
        });
    }
}

const menuNode = document.querySelector('.js-nav-menu');
const Menu = new NavigationMenu(menuNode);
// Слайдеры
var swiper1 = new Swiper('.swiper1', {
    slidesPerView: 1,
    spaceBetween: 10,
    breakpoints: {
        991: {
            slidesPerView: 2,
        },
        1199: {
            slidesPerView: 3,
        },
    },
    loop: true,
    navigation: {
        nextEl: '.swiper__arrow_next',
        prevEl: '.swiper__arrow_prev',
    },
    simulateTouch: false,
    observer: true,
    observeParents: true,
});

var swiper2 = new Swiper('.swiper2', {
    slidesPerView: 1,
    spaceBetween: 60,
    loop: true,
    navigation: {
        nextEl: '.swiper2__arrow_next',
        prevEl: '.swiper2__arrow_prev',
    },
    simulateTouch: false,
});
// Табы в недвижимости
$('.property__link').click(function (e) { 
    if ($(".property__link").hasClass("property__link_active")) {
        $(".property__link").removeClass("property__link_active");
    };
    $(this).addClass("property__link_active");
});

$(".property__link_first").click(function (e) { 
    $(".property__tab_first").fadeIn(1000);
    $(".property__tab_second").fadeOut(1000);
    $(".property__tab_second").addClass("d-none");
    $(".property__tab_first").removeClass("d-none");
});
$(".property__link_second").click(function (e) { 
    $(".property__tab_second").fadeIn(1000);
    $(".property__tab_first").fadeOut(1000);
    $(".property__tab_second").removeClass("d-none");
    $(".property__tab_first").addClass("d-none");
});
// Ипотека(Раскрывающийся список)
$(".form__select").click(function (e) {
    $(this).toggleClass("active");
});
$(document).mouseup(function (e) {
    var div = $(".select1");
    if (!div.is(e.target) && div.has(e.target).length === 0) {
        div.removeClass("active");
    }
});
$(document).mouseup(function (e) {
    var div = $(".select2");
    if (!div.is(e.target) && div.has(e.target).length === 0) {
        div.removeClass("active");
    }
});
// POPUP(Заказать звонок)
// открыть по кнопке
$('.js-button-first').click(function () {
    $('.js-overlay-first').fadeIn();
    $('body').addClass('scroll-disabled');
});
// закрыть на крестик
$('.js-close-first').click(function () {
    $('.js-overlay-first').fadeOut();
    $('body').removeClass('scroll-disabled');
});

// POPUP(Оставить заявку)
// открыть по кнопке
$('.js-button-second').click(function () {
    $('.js-overlay-second').fadeIn();
    $('body').addClass('scroll-disabled');
});
// закрыть на крестик
$('.js-close-second').click(function () {
    $('.js-overlay-second').fadeOut();
    $('body').removeClass('scroll-disabled');
});

// POPUP(Маска для ввода номера телефона)
// Маска для ввода телефона
$(".form__phone").mask("+7(999)999-99-99");

// Меню и бургер для телефонов
$(document).ready(function () {
    $(".header__burger").click(function (e) {
        $(".header__burger, .menu").toggleClass("active");
        $("body").toggleClass('lock');
    });
    $(".menu__item").click(function (e) {
        $(".header__burger").removeClass("active");
        $(".menu").removeClass("active");
        $("body").removeClass("lock");
    });
});