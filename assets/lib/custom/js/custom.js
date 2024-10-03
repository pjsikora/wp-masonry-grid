// Vimeo Vieo Function
Masonry_Grid_Vimeo();
function Masonry_Grid_Vimeo() {
    /*! vimeo-jquery-api 2016-05-05 */
    !function (a, b) {
        var c = {
            catchMethods: {methodreturn: [], count: 0}, init: function (b) {
                ;var c, d, e;
                b.originalEvent.origin.match(/vimeo/gi) && "data" in b.originalEvent && (e = "string" === a.type(b.originalEvent.data) ? a.parseJSON(b.originalEvent.data) : b.originalEvent.data, e && (c = this.setPlayerID(e), c.length && (d = this.setVimeoAPIurl(c), e.hasOwnProperty("event") && this.handleEvent(e, c, d), e.hasOwnProperty("method") && this.handleMethod(e, c, d))))
            }, setPlayerID: function (b) {
                return a("iframe[src*=" + b.player_id + "]")
            }, setVimeoAPIurl: function (a) {
                return "http" !== a.attr("src").substr(0, 4) ? "https:" + a.attr("src").split("?")[0] : a.attr("src").split("?")[0]
            }, handleMethod: function (a) {
                this.catchMethods.methodreturn.push(a.value)
            }, handleEvent: function (b, c, d) {
                switch (b.event.toLowerCase()) {
                    case"ready":
                        for (var e in a._data(c[0], "events")) e.match(/loadProgress|playProgress|play|pause|finish|seek|cuechange/) && c[0].contentWindow.postMessage(JSON.stringify({
                            method: "addEventListener",
                            value: e
                        }), d);
                        if (c.data("vimeoAPICall")) {
                            for (var f = c.data("vimeoAPICall"), g = 0; g < f.length; g++) c[0].contentWindow.postMessage(JSON.stringify(f[g].message), f[g].api);
                            c.removeData("vimeoAPICall")
                        }
                        c.data("vimeoReady", !0), c.triggerHandler("ready");
                        break;
                    case"seek":
                        c.triggerHandler("seek", [b.data]);
                        break;
                    case"loadprogress":
                        c.triggerHandler("loadProgress", [b.data]);
                        break;
                    case"playprogress":
                        c.triggerHandler("playProgress", [b.data]);
                        break;
                    case"pause":
                        c.triggerHandler("pause");
                        break;
                    case"finish":
                        c.triggerHandler("finish");
                        break;
                    case"play":
                        c.triggerHandler("play");
                        break;
                    case"cuechange":
                        c.triggerHandler("cuechange")
                }
            }
        }, d = a.fn.vimeoLoad = function () {
            var b = a(this).attr("src"), c = !1;
            if ("https:" !== b.substr(0, 6) && (b = "http" === b.substr(0, 4) ? "https" + b.substr(4) : "https:" + b, c = !0), null === b.match(/player_id/g)) {
                c = !0;
                var d = -1 === b.indexOf("?") ? "?" : "&",
                    e = a.param({api: 1, player_id: "vvvvimeoVideo-" + Math.floor(1e7 * Math.random() + 1).toString()});
                b = b + d + e
            }
            return c && a(this).attr("src", b), this
        };
        jQuery(document).ready(function () {
            a("iframe[src*='vimeo.com']").each(function () {
                d.call(this)
            })
        }), a(["loadProgress", "playProgress", "play", "pause", "finish", "seek", "cuechange"]).each(function (b, d) {
            jQuery.event.special[d] = {
                setup: function () {
                    var b = a(this).attr("src");
                    if (a(this).is("iframe") && b.match(/vimeo/gi)) {
                        var e = a(this);
                        if ("undefined" != typeof e.data("vimeoReady")) e[0].contentWindow.postMessage(JSON.stringify({
                            method: "addEventListener",
                            value: d
                        }), c.setVimeoAPIurl(a(this))); else {
                            var f = "undefined" != typeof e.data("vimeoAPICall") ? e.data("vimeoAPICall") : [];
                            f.push({message: d, api: c.setVimeoAPIurl(e)}), e.data("vimeoAPICall", f)
                        }
                    }
                }
            }
        }), a(b).on("message", function (a) {
            c.init(a)
        }), a.vimeo = function (a, d, e) {
            var f = {}, g = c.catchMethods.methodreturn.length;
            if ("string" == typeof d && (f.method = d), void 0 !== typeof e && "function" != typeof e && (f.value = e), a.is("iframe") && f.hasOwnProperty("method")) if (a.data("vimeoReady")) a[0].contentWindow.postMessage(JSON.stringify(f), c.setVimeoAPIurl(a)); else {
                var h = a.data("vimeoAPICall") ? a.data("vimeoAPICall") : [];
                h.push({message: f, api: c.setVimeoAPIurl(a)}), a.data("vimeoAPICall", h)
            }
            return "get" !== d.toString().substr(0, 3) && "paused" !== d.toString() || "function" != typeof e || (!function (a, d, e) {
                var f = b.setInterval(function () {
                    c.catchMethods.methodreturn.length != a && (b.clearInterval(f), d(c.catchMethods.methodreturn[e]))
                }, 10)
            }(g, e, c.catchMethods.count), c.catchMethods.count++), a
        }, a.fn.vimeo = function (b, c) {
            return a.vimeo(this, b, c)
        }
    }(jQuery, window);
}
// global variable for the action
var action = [];
var iframe = document.getElementsByClassName("video-main-wraper");
var src;
var ratio_class;
Masonry_Grid_Video();
Masonry_Grid_Video('video-main-wraper-2');
function Masonry_Grid_Video(VideoWraperClass = '', youtubeClass = 'twp-iframe-video-youtube') {
    if (VideoWraperClass) {
        iframe = document.getElementsByClassName(VideoWraperClass);
    }
    Array.prototype.forEach.call(iframe, function (el) {
        // Do stuff here
        var id = el.getAttribute("data-id");
        var autoplay = el.getAttribute("data-autoplay");
        if (autoplay == 'autoplay-enable') {
            autoplay = 1;
        } else {
            autoplay = 0;
        }
        jQuery(document).ready(function ($) {
            "use strict";
            src = $(el).find('iframe').attr('src');
            if (src) {
                if (src.indexOf('youtube.com') != -1) {
                    $(el).find('iframe').attr('width', '');
                    $(el).find('iframe').attr('height', '');
                    $(el).find('iframe').attr('id', id);
                    $(el).find('iframe').addClass(youtubeClass);
                    if (autoplay) {
                        $(el).find('iframe').attr('src', src + '&enablejsapi=1&autoplay=1&mute=1&rel=0&modestbranding=0&autohide=0&showinfo=0&controls=0&loop=1');
                    } else {
                        $(el).find('iframe').attr('src', src + '&enablejsapi=1');
                    }
                }
                if (src.indexOf('vimeo.com') != -1) {
                    $(el).find('iframe').attr('id', id);
                    $(el).find('iframe').addClass('twp-iframe-video-vimeo');
                    if (autoplay) {
                        $(el).find('iframe').attr('src', src + '&title=0&byline=0&portrait=0&transparent=0&autoplay=1&controls=0&loop=1');
                    } else {
                        $(el).find('iframe').attr('src', src + '&title=0&byline=0&portrait=0&transparent=0&autoplay=0&controls=0&loop=1');
                    }
                    $(el).find('iframe').attr('allow', 'autoplay;');
                    var player = document.getElementById(id);
                    $(player).vimeo("setVolume", 0);
                    $('#' + id).closest('.entry-video').find('.twp-mute-unmute').on('click', function () {
                        if ($(this).hasClass('unmute')) {
                            $(player).vimeo("setVolume", 1);
                            $(this).removeClass('unmute');
                            $(this).addClass('mute');
                            $(this).find('.twp-video-control-action').empty();
                            $(this).find('.twp-video-control-action').html(masonry_grid_custom.unmute);
                            $(this).find('.screen-reader-text').html(masonry_grid_custom.unmute_text);
                        } else if ($(this).hasClass('mute')) {
                            $(player).vimeo("setVolume", 0);
                            $(this).removeClass('mute');
                            $(this).addClass('unmute');
                            $(this).find('.twp-video-control-action').empty();
                            $(this).find('.twp-video-control-action').html(masonry_grid_custom.mute)
                        }
                    });
                    $('#' + id).closest('.entry-video').find('.twp-pause-play').on('click', function () {
                        if ($(this).hasClass('play')) {
                            $(player).vimeo('play');
                            $(this).removeClass('play');
                            $(this).addClass('pause');
                            $(this).find('.twp-video-control-action').html(masonry_grid_custom.pause);
                            $(this).find('.screen-reader-text').html(masonry_grid_custom.pause_text);
                        } else if ($(this).hasClass('pause')) {
                            $(player).vimeo('pause');
                            $(this).removeClass('pause');
                            $(this).addClass('play');
                            $(this).find('.twp-video-control-action').html(masonry_grid_custom.play);
                            $(this).find('.screen-reader-text').html(masonry_grid_custom.play_text);
                        }
                    });
                }
            } else {
                var currentVideo;
                $(el).find('video').attr('loop', 'loop');
                $(el).find('video').attr('autoplay', 'autoplay');
                $(el).find('video').removeAttr('controls');
                $(el).find('video').attr('id', id);
                $('#' + id).closest('.entry-video').find('.twp-mute-unmute').on('click', function () {
                    if ($(this).hasClass('unmute')) {
                        currentVideo = document.getElementById(id);
                        $(currentVideo).prop('muted', false);
                        $(this).removeClass('unmute');
                        $(this).addClass('mute');
                        $(this).find('.twp-video-control-action').html(masonry_grid_custom.unmute);
                        $(this).find('.screen-reader-text').html(masonry_grid_custom.unmute_text);
                    } else if ($(this).hasClass('mute')) {
                        currentVideo = document.getElementById(id);
                        $(currentVideo).prop('muted', true);
                        $(this).removeClass('mute');
                        $(this).addClass('unmute');
                        $(this).find('.twp-video-control-action').html(masonry_grid_custom.mute)
                    }
                });
                if (autoplay) {
                    setTimeout(function () {
                        if ($('#' + id).length) {
                            currentVideo = document.getElementById(id);
                            currentVideo.play();
                        }
                    }, 3000);
                }
                $('#' + id).closest('.entry-video').find('.twp-pause-play').on('click', function () {
                    if ($(this).hasClass('play')) {
                        currentVideo = document.getElementById(id);
                        currentVideo.play();
                        $(this).removeClass('play');
                        $(this).addClass('pause');
                        $(this).find('.twp-video-control-action').html(masonry_grid_custom.pause);
                        $(this).find('.screen-reader-text').html(masonry_grid_custom.pause_text);
                    } else if ($(this).hasClass('pause')) {
                        currentVideo = document.getElementById(id);
                        currentVideo.pause();
                        $(this).removeClass('pause');
                        $(this).addClass('play');
                        $(this).find('.twp-video-control-action').html(masonry_grid_custom.play);
                        $(this).find('.screen-reader-text').html(masonry_grid_custom.play_text);
                    }
                });
            }
        });
    });
}
// this function gets called when API is ready to use
function onYouTubePlayerAPIReady() {
    jQuery(document).ready(function ($) {
        "use strict";
        Masonry_GridYoutubeVideo('.twp-iframe-video-youtube');
    });
}
function Masonry_GridYoutubeVideo(YTVideoClass = '') {
    $(YTVideoClass).each(function () {
        var id = $(this).attr('id');
        // create the global action from the specific iframe (#video)
        action[id] = new YT.Player(id, {
            events: {
                // call this function when action is ready to use
                'onReady': function onReady() {
                    var autoplay = $(this).closest('.theme-video-panel').attr('data-autoplay');
                    if (autoplay == 'autoplay-enable') {
                        action[id].playVideo();
                    }
                    $('#' + id).closest('.entry-video').find('.twp-pause-play').on('click', function () {
                        var id = $(this).attr('attr-id');
                        if ($(this).hasClass('play')) {
                            action[id].playVideo();
                            $(this).removeClass('play');
                            $(this).addClass('pause');
                            $(this).find('.twp-video-control-action').html(masonry_grid_custom.pause);
                            $(this).find('.screen-reader-text').html(masonry_grid_custom.pause_text);
                        } else if ($(this).hasClass('pause')) {
                            action[id].pauseVideo();
                            $(this).removeClass('pause');
                            $(this).addClass('play');
                            $(this).find('.twp-video-control-action').html(masonry_grid_custom.play);
                            $(this).find('.screen-reader-text').html(masonry_grid_custom.play_text);
                        }
                    });
                    $('#' + id).closest('.entry-video').find('.twp-mute-unmute').on('click', function () {
                        var id = $(this).attr('attr-id');
                        if ($(this).hasClass('unmute')) {
                            action[id].unMute();
                            $(this).removeClass('unmute');
                            $(this).addClass('mute');
                            $(this).find('.twp-video-control-action').html(masonry_grid_custom.unmute);
                            $(this).find('.screen-reader-text').html(masonry_grid_custom.unmute_text);
                        } else if ($(this).hasClass('mute')) {
                            action[id].mute();
                            $(this).removeClass('mute');
                            $(this).addClass('unmute');
                            $(this).find('.twp-video-control-action').html(masonry_grid_custom.mute);
                            $(this).find('.screen-reader-text').html(masonry_grid_custom.mute_text);
                        }
                    });
                },
            }
        });
    });
}
// Inject YouTube API script
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
function Masonry_Grid_SetCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function Masonry_Grid_GetCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
jQuery(document).ready(function ($) {
    "use strict";
    var myCursor = jQuery('.theme-custom-cursor');
    if (myCursor.length) {
        if ($('body')) {
            const e = document.querySelector('.theme-cursor-secondary'),
                t = document.querySelector('.theme-cursor-primary');
            let n, i = 0,
                o = !1;
            window.onmousemove = function (s) {
                o || (t.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)"), e.style.transform = "translate(" + s.clientX + "px, " + s.clientY + "px)", n = s.clientY, i = s.clientX
            }, $('body').on("mouseenter", "a, button, input[type=\"submit\"], .cursor-pointer", function () {
                e.classList.add('cursor-hover'), t.classList.add('cursor-hover')
            }), $('body').on("mouseleave", "a, button, input[type=\"submit\"], .cursor-pointer", function () {
                $(this).is("a") && $(this).closest(".cursor-pointer").length || (e.classList.remove('cursor-hover'), t.classList.remove('cursor-hover'))
            }), e.style.visibility = "visible", t.style.visibility = "visible"
        }
    }
    // Mouse Custom Pointer Cursors Start
    $(window).load(function () {
        $("body").addClass("page-loaded");
    });
    // Scroll To
    $(".scroll-content").click(function () {
        $('html, body').animate({
            scrollTop: $("#content").offset().top
        }, 500);
    });
    $('a').mouseenter(function () {
        $('.circle1').addClass('hover-link-active-1');
        $('.circle2').addClass('hover-link-active-2');
    });
    $('a').mouseleave(function () {
        $('.circle1').removeClass('hover-link-active-1');
        $('.circle2').removeClass('hover-link-active-2');
    });
    // Hide Comments
    $('.masonry-grid-no-comment .booster-block.booster-ratings-block, .masonry-grid-no-comment .comment-form-ratings, .masonry-grid-no-comment .twp-star-rating').hide();
    // Rating disable
    if (masonry_grid_custom.single_post == 1 && masonry_grid_custom.masonry_grid_ed_post_reaction) {
        $('.tpk-single-rating').remove();
        $('.tpk-comment-rating-label').remove();
        $('.comments-rating').remove();
        $('.tpk-star-rating').remove();
    }
    // Add Class on article
    $('.twp-archive-items.post').each(function () {
        $(this).addClass('twp-article-loded');
    });
    // Social Share Stickey
    $('.post-content-share').theiaStickySidebar();
    // Aub Menu Toggle
    $('.submenu-toggle').click(function () {
        $(this).toggleClass('button-toggle-active');
        var currentClass = $(this).attr('data-toggle-target');
        $(currentClass).toggleClass('submenu-toggle-active');
    });
    // Header Search Popup End
    $('.navbar-control-search').click(function () {
        $('.header-searchbar').toggleClass('header-searchbar-active');
        $('body').addClass('body-scroll-locked');
        $('#search-closer').focus();
    });
    $('.header-searchbar').click(function () {
        $('.header-searchbar').removeClass('header-searchbar-active');
        $('body').removeClass('body-scroll-locked');
    });
    $(".header-searchbar-inner").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    // Header Search hide
    $('#search-closer').click(function () {
        $('.header-searchbar').removeClass('header-searchbar-active');
        $('body').removeClass('body-scroll-locked');
        setTimeout(function () {
            $('.navbar-control-search').focus();
        }, 300);
    });
    // Focus on search input on search icon expand
    $('.navbar-control-search').click(function () {
        setTimeout(function () {
            $('.header-searchbar .search-field').focus();
        }, 300);
    });
    $('input, a, button').on('focus', function () {
        if ($('.header-searchbar').hasClass('header-searchbar-active')) {
            if (!$(this).parents('.header-searchbar').length) {
                $('.header-searchbar .search-field').focus();
                $('.header-searchbar-area .search-field-default').focus();
            }
        }
    });
    $('.skip-link-search-start').focus(function () {
        $('#search-closer').focus();
    });
    $('.skip-link-search-end').focus(function () {
        $('.header-searchbar-area .search-field').focus();
    });
    $('.skip-link-menu-start').focus(function () {
        if (!$("#offcanvas-menu #primary-nav-offcanvas").length == 0) {
            $("#offcanvas-menu #primary-nav-offcanvas ul li:last-child a").focus();
        }
        if (!$("#offcanvas-menu #social-nav-offcanvas").length == 0) {
            $("#offcanvas-menu #social-nav-offcanvas ul li:last-child a").focus();
        }
    });
    // Action On Esc Button For Search
    $(document).keyup(function (j) {
        $('body').removeClass('body-scroll-locked');
        if (j.key === "Escape") { // escape key maps to keycode `27`
            if ($('.header-searchbar').hasClass('header-searchbar-active')) {
                $('.header-searchbar').removeClass('header-searchbar-active');
                setTimeout(function () {
                    $('.navbar-control-search').focus();
                }, 300);
                setTimeout(function () {
                    $('.aside-search-js').focus();
                }, 300);
            }
        }
    });
    // Header Search Popup End
    // Action On Esc Button For Offcanvas
    $(document).keyup(function (j) {
        if (j.key === "Escape") { // escape key maps to keycode `27`
            if ($('#offcanvas-menu').hasClass('offcanvas-menu-active')) {
                $('.header-searchbar').removeClass('header-searchbar-active');
                $('#offcanvas-menu').removeClass('offcanvas-menu-active');
                $('.navbar-control-offcanvas').removeClass('active');
                $('body').removeClass('body-scroll-locked');
                setTimeout(function () {
                    $('.navbar-control-offcanvas').focus();
                }, 300);
            }
        }
    });
    // Toggle Menu Start
    $('.navbar-control-offcanvas').click(function () {
        $(this).addClass('active');
        $('body').addClass('body-scroll-locked');
        $('#offcanvas-menu').toggleClass('offcanvas-menu-active');
        $('.button-offcanvas-close').focus();
    });
    $('.offcanvas-close .button-offcanvas-close').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
        $('html').removeAttr('style');
        $('.navbar-control-offcanvas').focus();
    });
    $('#offcanvas-menu').click(function () {
        $('#offcanvas-menu').removeClass('offcanvas-menu-active');
        $('.navbar-control-offcanvas').removeClass('active');
        $('body').removeClass('body-scroll-locked');
    });
    $(".offcanvas-wraper").click(function (e) {
        e.stopPropagation(); //stops click event from reaching document
    });
    $('.skip-link-menu-end').focus(function () {
        $('.button-offcanvas-close').focus();
    });
    // Toggle Menu End
    // Data Background
    var pageSection = $(".data-bg");
    pageSection.each(function (indx) {
        var src = $(this).attr("data-background");
        if (src) {
            $(this).css("background-image", "url(" + src + ")");
        }
    });
    var rtled = false;
    if ($('body').hasClass('rtl')) {
        rtled = true;
    }
    // Carousel Block Home
    $(".mg-carousel-action").each(function () {
        $(this).slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-next-icon"></button>',
            prevArrow: '<button type="button" class="slide-btn slide-prev-icon"></button>',
            responsive: [
                {
                    breakpoint: 1400,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
    // Content Gallery Slide Start
    $("figure.wp-block-gallery.has-nested-images.columns-1, .wp-block-gallery.columns-1 ul.blocks-gallery-grid, .gallery-columns-1").each(function () {
        $(this).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<button type="button" class="slide-btn slide-next-icon"></button>',
            prevArrow: '<button type="button" class="slide-btn slide-prev-icon"></button>',
            dots: false,
            rtl: rtled,
        });
    });
    // Content Gallery End
    // Content Gallery popup Start
    $('.entry-content .gallery, .widget .gallery, .wp-block-gallery').each(function () {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    return item.el.attr('title');
                }
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300,
                opener: function (element) {
                    return element.find('img');
                }
            }
        });
    });
    // Content Gallery popup End
    // flatten object by concatting values
    function concatValues(obj) {
        var value = '';
        for (var prop in obj) {
            value += obj[prop];
        }
        return value;
    }
    // init Isotope
    var filterContainer = $('.twp-active-isotope').isotope({
        itemSelector: '.twp-archive-items-main',
        masonry: {
            columnWidth: '.mg-grid-sizer'
        },
        sortAscending: false,
        category: '[data-category]',
        getSortData: {
            number: function (item) {
                return parseFloat($(item).find(".twp-post-views").text());
            },
            points: function (item) {
                return parseFloat($(item).find(".twp-post-like").text());
            }
        },
    });
    // layout Isotope after each image loads
    filterContainer.imagesLoaded().progress(function () {
        filterContainer.isotope('layout');
    });
    // bind filter on select change
    $('.theme-categories-dropdown').on('click', 'button', function () {
        // get filter value from option value
        var filterValue = $(this).attr('data-filter');
        var filterhtml = $(this).find('span').html();
        var filterclass = $(this).attr('class');
        $(this).hide();
        $('.theme-categories-selected').append('<button class="twp-filter-' + filterclass + '" data-filter="' + filterValue + '"><span class="action-control-trigger" tabindex="-1">' + filterhtml + '<span class="theme-filter-icon">' + masonry_grid_custom.cross + '</span></span></button>')
        $('.theme-categories-selected button').click(function () {
            $('.theme-categories-dropdown .' + filterclass).show();
            $(this).remove();
            // use filterFn if matches value
            masonry_grid_active_filter();
        });
        // use filterFn if matches value
        masonry_grid_active_filter();
    });
    $('.article-format-filter button').click(function () {
        if ($(this).hasClass('post-formate-filter-active')) {
            $(this).toggleClass('post-formate-filter-active');
        } else {
            $('.article-format-filter button').removeClass('post-formate-filter-active');
            $(this).toggleClass('post-formate-filter-active');
        }
        masonry_grid_active_filter();
    });
    $('.theme-categories-selection, .theme-categories-dropdown').mouseenter(function () {
        $('.article-categories-filter').addClass('theme-categories-selection-active');
    });
    $('.theme-categories-selection, .theme-categories-dropdown').mouseleave(function () {
        $('.article-categories-filter').removeClass('theme-categories-selection-active');
    });
    $('.theme-categories-selection').click(function () {
        $('.article-categories-filter').toggleClass('theme-categories-selection-active');
    });
    $('.twp-most-liked').click(function () {
        $(this).toggleClass('twp-orderby-active');
        $('.twp-most-viewed').removeClass('twp-orderby-active');
        masonry_grid_active_filter();
    });
    $('.twp-most-viewed').click(function () {
        $(this).toggleClass('twp-orderby-active');
        $('.twp-most-liked').removeClass('twp-orderby-active');
        masonry_grid_active_filter();
    });
    var mtFilterReset;
    $('.article-filter-clear').click(function () {
        if ($(this).hasClass('filter-clear-selected')) {
            $('.article-filter-clear').removeClass('filter-clear-selected');
            $('.article-format-filter button').removeClass('post-formate-filter-active');
            $('.theme-categories-selected').empty();
            $('.twp-most-liked').removeClass('twp-orderby-active');
            $('.twp-most-viewed').removeClass('twp-orderby-active')
            masonry_grid_active_filter(mtFilterReset = false);
        }
    });
    function masonry_grid_active_filter(mtFilterReset = true) {
        if (mtFilterReset) {
            $('.article-filter-clear').addClass('filter-clear-selected');
        }
        var filterContent = {};
        var filterCat = '';
        var j = 1;
        $('.theme-categories-selected button').each(function () {
            if (j == 1) {
                filterCat += $(this).attr('data-filter');
            } else {
                filterCat += ', ' + $(this).attr('data-filter');
            }
            j++;
        });
        if (filterCat) {
            filterContent['category'] = filterCat;
        } else {
            var filterCat = '*';
        }
        var filterFormate = '';
        $('.article-format-filter button').each(function () {
            if ($(this).hasClass('post-formate-filter-active')) {
                filterFormate += $(this).attr('data-filter');
            }
        });
        if (filterFormate) {
            filterContent['formate'] = filterFormate;
        } else {
            var filterFormate = '*';
        }
        var filterValue = concatValues(filterContent);
        var order_by = '';
        if ($('.twp-most-liked').hasClass('twp-orderby-active')) {
            order_by = 'points';
        }
        if ($('.twp-most-viewed').hasClass('twp-orderby-active')) {
            order_by = 'number';
        }
        if (order_by) {
            filterContainer.isotope({filter: filterValue, sortAscending: false, sortBy: order_by});
        } else {
            filterContainer.isotope({filter: filterValue, sortAscending: true, sortBy: 'original-order'});
        }
    }
    // Navigation toggle on scroll
    $(window).scroll(function () {
        if ($(window).scrollTop() > $(window).height() / 2) {
            $('body').addClass('theme-floatingbar-active');
        } else {
            $('body').removeClass('theme-floatingbar-active');
        }
    });
    // Scroll to Top on Click
    $('.to-the-top').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 700);
        return false;
    });
    // Widgets Tab
    $('.twp-nav-tabs .tab').on('click', function (event) {
        var tabid = $(this).attr('tab-data');
        $(this).closest('.tabbed-container').find('.tab').removeClass('active');
        $(this).addClass('active');
        $(this).closest('.tabbed-container').find('.tab-content .tab-pane').removeClass('active');
        $(this).closest('.tabbed-container').find('.content-' + tabid).addClass('active');
    });
    // Day Night Mode Start
    $('.navbar-day-night').on("click", function () {
        if ($(this).hasClass('navbar-day-on')) {
            $('html').removeClass('night-mode');
            $('html').addClass('night-mode');
            $('.navbar-day-night').addClass('navbar-night-on');
            $('.navbar-day-night').removeClass('navbar-day-on');
            $('.jl_en_day_night').addClass('options_dark_skin');
            $('.mobile_nav_class').addClass('wp-night-mode-on');
            Masonry_Grid_SetCookie('MasonryGridNightDayMode', 'true', 365);
        } else if ($(this).hasClass('navbar-night-on')) {
            $('html').removeClass('night-mode');
            $('.navbar-day-night').addClass('navbar-day-on');
            $('.navbar-day-night').removeClass('navbar-night-on');
            $('.jl_en_day_night').removeClass('options_dark_skin');
            $('.mobile_nav_class').removeClass('wp-night-mode-on');
            Masonry_Grid_SetCookie('MasonryGridNightDayMode', 'false', 365);
        }
    });
    // Add class and remove on element regarding mode
    if (Masonry_Grid_GetCookie('MasonryGridNightDayMode') == 'true') {
        $('html').addClass('night-mode');
        $('.navbar-day-night ').removeClass('navbar-day-on');
        $('.navbar-day-night ').addClass('navbar-night-on');
    } else {
        $('html').removeClass('night-mode');
        $('.navbar-day-night ').removeClass('navbar-night-on');
        $('.navbar-day-night ').addClass('navbar-day-on');
    }
    // Day Night Mode End
});
/*  -----------------------------------------------------------------------------------------------
    Intrinsic Ratio Embeds
--------------------------------------------------------------------------------------------------- */
var MasonryGrid = MasonryGrid || {},
    $ = jQuery;
var $masonry_grid_doc = $(document),
    $masonry_grid_win = $(window),
    viewport = {};
viewport.top = $masonry_grid_win.scrollTop();
viewport.bottom = viewport.top + $masonry_grid_win.height();
MasonryGrid.instrinsicRatioVideos = {
    init: function () {
        MasonryGrid.instrinsicRatioVideos.makeFit();
        $masonry_grid_win.on('resize fit-videos', function () {
            MasonryGrid.instrinsicRatioVideos.makeFit();
        });
    },
    makeFit: function () {
        var vidSelector = "iframe, .format-video object, .format-video video";
        $(vidSelector).each(function () {
            var $masonry_grid_video = $(this),
                $masonry_grid_container = $masonry_grid_video.parent(),
                masonry_grid_iTargetWidth = $masonry_grid_container.width();
            // Skip videos we want to ignore
            if ($masonry_grid_video.hasClass('intrinsic-ignore') || $masonry_grid_video.parent().hasClass('intrinsic-ignore')) {
                return true;
            }
            if (!$masonry_grid_video.attr('data-origwidth')) {
                // Get the video element proportions
                $masonry_grid_video.attr('data-origwidth', $masonry_grid_video.attr('width'));
                $masonry_grid_video.attr('data-origheight', $masonry_grid_video.attr('height'));
            }
            // Get ratio from proportions
            var masonry_grid_ratio = masonry_grid_iTargetWidth / $masonry_grid_video.attr('data-origwidth');
            // Scale based on ratio, thus retaining proportions
            $masonry_grid_video.css('width', masonry_grid_iTargetWidth + 'px');
            $masonry_grid_video.css('height', ($masonry_grid_video.attr('data-origheight') * masonry_grid_ratio) + 'px');
        });
    }
};
$masonry_grid_doc.ready(function () {
    MasonryGrid.instrinsicRatioVideos.init();      // Retain aspect ratio of videos on window resize
});