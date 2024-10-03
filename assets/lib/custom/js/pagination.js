jQuery(document).ready(function ($) {

    var ajaxurl = masonry_grid_pagination.ajax_url;

    function masonry_grid_is_on_screen(elem) {

        if ($(elem)[0]) {

            var tmtwindow = jQuery(window);
            var viewport_top = tmtwindow.scrollTop();
            var viewport_height = tmtwindow.height();
            var viewport_bottom = viewport_top + viewport_height;
            var tmtelem = jQuery(elem);
            var top = tmtelem.offset().top;
            var height = tmtelem.height();
            var bottom = top + height;
            return (top >= viewport_top && top < viewport_bottom) ||
                (bottom > viewport_top && bottom <= viewport_bottom) ||
                (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom);
        }
    }

    var n = window.TWP_JS || {};
    var paged = parseInt(masonry_grid_pagination.paged) + 1;
    var maxpage = masonry_grid_pagination.maxpage;
    var nextLink = masonry_grid_pagination.nextLink;
    var loadmore = masonry_grid_pagination.loadmore;
    var loading = masonry_grid_pagination.loading;
    var nomore = masonry_grid_pagination.nomore;
    var pagination_layout = masonry_grid_pagination.pagination_layout;

    var permalink_structure = masonry_grid_pagination.permalink_structure;

    function masonry_grid_load_content_ajax(){

        if ((!$('.theme-no-posts').hasClass('theme-no-posts'))) {

            $('.theme-loading-button .loading-text').text(loading);
            $('.theme-loading-status').addClass('theme-ajax-loading');
            $('.theme-loaded-content').load(nextLink + ' .article-panel-blocks', function () {
                paged++;
                if (paged < 10) {
                    var newlink = nextLink.substring(0, nextLink.length - 2);
                } else {
                    var newlink = nextLink.substring(0, nextLink.length - 3);
                }
                if (permalink_structure == '') {
                    newlink = newlink.replace('=', '');
                    nextLink = newlink + "=" + paged + '/';
                } else {
                    nextLink = newlink + paged + '/';
                }
                if (paged > maxpage) {
                    $('.theme-loading-button').addClass('theme-no-posts');
                    $('.theme-loading-button .loading-text').text(nomore);
                } else {
                    $('.theme-loading-button .loading-text').text(loadmore);
                }

                $('.theme-loaded-content .twp-archive-items-main').each(function(){
                    $(this).addClass(paged + '-twp-article-ajax after-ajax-load');
                    $(this).find('.video-main-wraper').removeClass('video-main-wraper').addClass('video-main-wraper-ajax');
                });

                if ($('.theme-panelarea').hasClass('theme-panelarea-blocks')) {

                    if ($('.theme-panelarea-blocks').length > 0) {

                        
                        $('.theme-loaded-content .theme-video-panel').each(function(){

                            var autoplay = $(this).attr('data-autoplay');
                            var vidURL = $(this).find('iframe').attr('src');
                            
                            if( vidURL ){

                                if( vidURL.indexOf('youtube.com') != -1 ){

                                    if( autoplay == 'autoplay-enable' ){
                                        $(this).find('iframe').attr('src',vidURL+'&enablejsapi=1&autoplay=1&mute=1&rel=0&modestbranding=0&autohide=0&showinfo=0&controls=0&loop=1');
                                    }else{
                                        $(this).find('iframe').attr('src',vidURL+'&enablejsapi=1&mute=1');
                                    }

                                }

                                if( vidURL.indexOf('vimeo.com') != -1 ){

                                    if( autoplay == 'autoplay-enable' ){
                                        $(this).find('iframe').attr('src',vidURL+'&title=0&byline=0&portrait=0&transparent=0&autoplay=1&controls=0&loop=1');
                                    }else{
                                        $(this).find('iframe').attr('src',vidURL+'&title=0&byline=0&portrait=0&transparent=0&autoplay=0&controls=0&loop=1');
                                    }
                                    
                                    
                                }

                            }

                        });

                        $('.theme-loaded-content .twp-latest-posts-block').each(function(){
                            
                            $(this).addClass(paged + '-twp-article-ajax');
                            $(this).addClass('theme-article-loaded');
                            $(this).find('.theme-video-panel').addClass( paged + '-twp-video-ajax' );
                            $(this).find('.theme-video-panel').removeClass('video-main-wraper');

                        });

                        var lodedContent = $('.theme-loaded-content').html();
                        $('.theme-loaded-content').html('');

                        var content = $(lodedContent);
                        var grid = $('.theme-panelarea-blocks');
                        var filterContainer = $('.twp-active-isotope');
                        var content = $(lodedContent);
                        filterContainer.append( content )
                        // add and lay out newly appended elements
                        .isotope( 'appended', content );

                        grid.imagesLoaded(function () {

                            var rtled = false;

                            if( $('body').hasClass('rtl') ){
                                rtled = true;
                            }

                            $( '.'+paged + '-twp-article-ajax figure.wp-block-gallery.has-nested-images.columns-1, .'+paged + '-twp-article-ajax .wp-block-gallery.columns-1 ul.blocks-gallery-grid, .'+paged + '-twp-article-ajax .gallery-columns-1').each(function () {
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

                        });

                    }

                } else {

                    $('.content-area .theme-panelarea').append(lodedContent);

                }

                $('.theme-loading-status').removeClass('theme-ajax-loading');

                var action = [];
                var iframe;
                var src;
                var ratio_class;

                Masonry_Grid_Vimeo();
                Masonry_Grid_Video( paged + '-twp-video-ajax', paged + '-twp-video-ajax-2' );

                onYouTubePlayerAPIReady();
                function onYouTubePlayerAPIReady() {

                    jQuery(document).ready(function ($) {
                        "use strict";
                        Masonry_GridYoutubeVideo( '.'+paged + '-twp-video-ajax-2' );

                    });
                }

                // Inject YouTube API script
                var tag = document.createElement('script');
                tag.src = "https://www.youtube.com/player_api";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                $('.twp-archive-items-main').each(function(){

                    $(this).removeClass('slick-slider-active');

                });

            });

        }
    }

    $('.theme-loading-button').click(function () {

        masonry_grid_load_content_ajax();
        
    });

    if (pagination_layout == 'auto-load') {
        $(window).scroll(function () {

            if (!$('.theme-loading-status').hasClass('theme-ajax-loading') && !$('.theme-loading-button').hasClass('theme-no-posts') && maxpage > 1 && masonry_grid_is_on_screen('.theme-loading-button')) {
                
                masonry_grid_load_content_ajax();
                
            }

        });
    }

    $(window).scroll(function () {

        if (!$('.twp-single-infinity').hasClass('twp-single-loading') && $('.twp-single-infinity').attr('loop-count') <= 3 && masonry_grid_is_on_screen('.twp-single-infinity')) {

            $('.twp-single-infinity').addClass('twp-single-loading');
            var loopcount = $('.twp-single-infinity').attr('loop-count');
            var postid = $('.twp-single-infinity').attr('next-post');

            var data = {
                'action': 'masonry_grid_single_infinity',
                '_wpnonce': masonry_grid_pagination.ajax_nonce,
                'postid': postid,
            };

            $.post(ajaxurl, data, function (response) {

                if (response) {
                    var content = response.data.content.join('');
                    var content = $(content);
                    $('.twp-single-infinity').before(content);
                    var newpostid = response.data.postid.join('');
                    $('.twp-single-infinity').attr('next-post', newpostid);

                    if ($('body').hasClass('booster-extension')) {
                        likedislike('after-load-ajax-'+postid);
                        booster_extension_post_reaction('after-load-ajax-'+postid);
                    }
                    
                    // Content Gallery Slide Start
                    var rtled = false;

                    if( $('body').hasClass('rtl') ){
                        rtled = true;
                    }

                    $(".after-load-ajax-"+postid+" figure.wp-block-gallery.has-nested-images.columns-1,.after-load-ajax-"+postid+" .wp-block-gallery.columns-1 ul.blocks-gallery-grid, .after-load-ajax-"+postid+"  .gallery-columns-1").each(function () {
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
                            rtl: rtled
                        });
                    });
                    // Content Gallery End

                    // Content Gallery popup Start
                    $('.after-load-ajax .entry-content .gallery, .widget .gallery, .after-load-ajax .wp-block-gallery').each(function () {
                        
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

                    $('article').each(function () {
                        $(this).removeClass('after-load-ajax');
                    });

                }

                $('.twp-single-infinity').removeClass('twp-single-loading');
                loopcount++;
                $('.twp-single-infinity').attr('loop-count', loopcount);

            });

        }

    });

});