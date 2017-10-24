/**
 *
 * Created by:  Milan Simek
 * Company:     Plugin Company
 *
 * LICENSE: http://plugin.company/docs/magento-extensions/magento-extension-license-agreement
 *
 * YOU WILL ALSO FIND A PDF COPY OF THE LICENSE IN THE DOWNLOADED ZIP FILE
 *
 * FOR QUESTIONS AND SUPPORT
 * PLEASE DON'T HESITATE TO CONTACT US AT:
 *
 * SUPPORT@PLUGIN.COMPANY
 *
 */

var PCCForms = false;
var PCCFThemes = [];
var PCCBaseJSURL;
var PCCFLightbox = false;
var currentRevisionForm;
var RECAPTCHA_PUBLIC_KEY = '';
var PCCFileUploadUrl;
var PCCFDate;
var PCCFVisualCaptchaUrl;
var pc_resizing = false;
var $PC;
var PCCFDependentFields = [];

/**
 * Used to modify formdummy element to form element
 * By default embedding forms on other form elements is not allowed in HTML
 * This workaround fixes this issue for pop-up forms embedded in product pages
 */
function initChangeElement(){
    $PC.fn.changeElementType = function(newType) {
        this.each(function() {
            var attrs = {};

            $PC.each(this.attributes, function(idx, attr) {
                attrs[attr.nodeName] = attr.nodeValue;
            });

            $PC(this).replaceWith(function() {
                return $PC("<" + newType + "/>", attrs).append($PC(this).contents());
            });
        });
    };
}

head.ready(document, function () {
    //if no forms, no need to load PCCForms is set by widget/view.phtml
    if(!PCCForms){
        return false;
    }

    //load recaptcha api

    if (!window.jQuery) {
        //if needed load jQuery
        head.load(PCCBaseJSURL + "jquerynoconflict.js", function () {
            //after jquery load init all
            if(typeof $PC == "undefined"){
                $PC = jQuery.noConflict(true);
            }
            if(typeof jQuery == "undefined"){
                jQuery = $PC;
            }
            //init all
            initPCCFAll();
        })
    }else{
        if(!PCCFCheckMinVersion("1.9.1",jQuery.fn.jquery)){
            head.load(PCCBaseJSURL + "jquerynoconflict.js", function () {
                if(typeof $PC == "undefined"){
                    $PC = jQuery.noConflict(true);
                }
                if(typeof jQuery == "undefined"){
                    jQuery = $PC;
                }
                //init all
                initPCCFAll();
            });
        }else{
            //init all
            if(typeof $PC == "undefined"){
                $PC = jQuery;
            }
            if(typeof jQuery == "undefined"){
                jQuery = $PC;
            }
            initPCCFAll();
        }
    }

});

/**
 * Initial constructor for all form methods
 */
function initPCCFAll() {
    initChangeElement();

    //load themes
    loadPCCFThemes();

    //load form.js
    head.load(PCCBaseJSURL + 'contactforms/lib/jquery.form.js',function() {
        initPccf();
    });


    //init pages
    initPCCFPages();

    //load lightbox
    if(PCCFLightbox) {
        pccfLightbox();
    }

    //init upload fields
    initPCCFUploadFields();

    //init datetime fields
    initPCCFDate();

    //init visual captcha fields
    initPCCFCaptcha();

    //init recaptcha
    initPCCFReCaptcha();

    //init slideout forms
    initPCCFSlideOut();
}


/**
 * Loads all needed theme files dynamically using AJAX
 */
function loadPCCFThemes() {
    //load shared css
    head.load(PCCBaseJSURL + "contactforms/css/shared.css");
    var alreadyAdded = [];
    var urls = [];
    //loop through themes set in widget/view.phtml
    $PC.each(PCCFThemes, function (k, v) {
        //check if theme is not added yet
        if($PC.inArray(v,alreadyAdded) < 0){
            alreadyAdded.push(v);
            urls.push(PCCBaseJSURL + "contactforms/css/themes/" + v + ".css")
        }
    });
    head.load(urls,function() {
        PCCFAfterThemesLoaded();
    })
    if(urls.length == 1){ //prototypejs adds function to array, making empty array have length of 1
        PCCFAfterThemesLoaded();
    }
}

function PCCFAfterThemesLoaded(){
    initPCCFRTL();

    $PC('.pccf_loader').fadeOut('normal',function() {
        $PC(this).next().css({ 'visibility':'visible',opacity:0}).animate({opacity: 1.0});
        $PC(this).remove();
    });

    //load html5shiv and respond.js if ie8 or below
    if(typeof oldBrowser != "undefined"){
        head.load(PCCBaseJSURL + "lib/html5shiv.min.js")
        head.load(PCCBaseJSURL + "lib/respond.min.js")
    }
}
/**
 * Initializes slide-out form functionality
 */
function initPCCFSlideOut() {
    $PC('.open_pcform').css('visibility','hidden');
    if(typeof PCCFSlideout == 'undefined' ){
        return;
    }

    head.load(PCCBaseJSURL + "contactforms/css/iconfont/css/pccontact.css");
    head.load(PCCBaseJSURL + "contactforms/css/slideout.css",function() {
        $PC('.pcform_slide').prependTo('body').css('z-index',10001).fadeIn();
        $PC('.pcform_bottom_left,.pcform_bottom_right').each(function() {
            var height = $PC(this).find('.pccf').height() + 'px';
            $PC(this)
                .css('bottom','-' + height)
                .css('height',height)
            ;
            var that = $PC(this);
            $PC(this).find('button').click(function() {
                slideOutResize(that);
            })
            $PC(this).find('input').keypress(function() {
                slideOutResize(that);
            })
        })
    });


    initPCCFanimateCSS();

    setTimeout(function() {
        $PC('.open_pcform').css('visibility','visible');
        head.load(PCCBaseJSURL + "contactforms/lib/jquery.scrollbar.min.js",function(){
            $PC('.pcform_slide .slideout_scroll_wrapper').scrollbar();
        })
    },1500)
}

/**
 * Resizes slide out forms to match size of contents
 *
 * @param element
 * @param adjustMargin
 */
function slideOutResize(element,adjustMargin) {
    var element = element;
    var adjustm = false;
    if(typeof adjustMargin !== "undefined"){
        adjustm = true;
    }

    doSlideOutResize(element,adjustm);
    setTimeout(function() {
        doSlideOutResize(element,adjustm);
    },1)
    setTimeout(function() {
        doSlideOutResize(element,adjustm);
    },5)
    setTimeout(function() {
        doSlideOutResize(element,adjustm);
    },7)
    setTimeout(function() {
        doSlideOutResize(element,adjustm);
    },10)
    setTimeout(function() {
        doSlideOutResize(element,adjustm);
    },100)
    setTimeout(function() {
        doSlideOutResize(element,adjustm);
    },500)
    setTimeout(function() {
        doSlideOutResize(element,adjustm);
    },1000)
    setTimeout(function() {
        doSlideOutResize(element,adjustm);
    },1500)
}

/**
 * Resizes slide-out forms to match content size
 *
 * @param element
 * @param adjustm
 */
function doSlideOutResize(element,adjustm){
    var element = element;
    var adjustm = adjustm;
    var height = element.find('.slideout_scroll_wrapper').height() + 'px';
    element
        .css('height',height)
    ;
    if(adjustm){
        element
            .css('bottom','-' + height);
    }
}

/**
 * Initializes actual contact form functionality
 */
function initPccf(){
    //custom varien validator for checkboxes
    Validation.add('validate-one-required-custom','Please select one of the above options.', function (v,elm) {
        var p = elm.parentNode.parentNode;
        var options = p.getElementsByTagName('INPUT');
        return $A(options).any(function(elm) {
            return $F(elm);
        });
    });

    var i = 0;
    $PC('.pccform').each(function(){
        i++;
        var form = $PC(this);

        //set unique id for each form and elements, for validation
        form.attr('id','pccf_' + i);
        form.parents('.pccf').each(function() {
            $PC(this).attr('id',$PC(this).attr('id') + i);
            var prev = $PC(this).parent().prev();
            if(prev.is('.pccflightbox')){
                prev.attr('href',prev.attr('href') + i);
            }else if(prev){
                prev.find('.pccflightbox').each(function(){
                    $PC(this).attr('href',$PC(this).attr('href') + i);
                })
            }
        })

        if(form.parents('.pccf_lightbox_wrapper').length || form.parents('.pcform_slide')){
            form.parents('.pccf_lightbox_wrapper').prependTo('body');
            form.changeElementType('form');
            form = $PC('#' + form.attr('id'));
        }

        form.find('input,textarea,select,button,p,h1,h2,h3,h4,h5,h6,h7').each(function() {
            if($PC(this).attr('id') && $PC(this).attr('id').indexOf('captcha') == '-1'){
                $PC(this).attr('id', $PC(this).attr('id') + i);
                if($PC(this).attr('name') ){
                    if($PC(this).attr('multiple') || $PC(this).attr('type') == 'checkbox'){
                        $PC(this).attr('name', $PC(this).attr('name') + i + '[]');
                    }else{
                        $PC(this).attr('name', $PC(this).attr('name') + i);
                    }
                }
            }
        })

        //adjust labels for new ids
        form.find('label').each(function() {
            $PC(this).attr('for', $PC(this).attr('for') + i);
        })

        form.append('<input type="hidden" name="form_increment" id="form_increment" value="' + i + '" />')
        form.append('<input class="pcc_uid" type="hidden" name="form_unique_id" value="' + PCRandId() + '" />')

        form.find('.captcha').attr('id', 'captchawrapper' + i);

        //focus on first field, if only one form is present
        if($PC('.pccform').length > 1)
        {
            var focusFirstField = false;
        }else{
            var focusFirstField = true;
        }

        //init validator
        new VarienForm('pccf_' + i, focusFirstField);

        //init ajax form submit
        form.ajaxForm({
            beforeSubmit: function(){
                form.parents('.pccformwrapper').find('.submitting').fadeIn();
            },
            success: function(responseText) {
                if(responseText == 'captcha_error')
                {
                    grecaptcha.reset();
                    form.parents('.pccformwrapper').find('.submitting').fadeOut(function(){
                        $PC('<div style="display:none;" class="alert alert-warning" role="alert">Captcha validation failed, please try again.</div>')
                            .prependTo(form).fadeIn().delay(4000).fadeOut(function() {
                                $PC(this).parents('.pcform_bottom_right,.pcform_bottom_left').each(function() {
                                    slideOutResize($PC(this));
                                })
                            });
                        ;
                    });
                    return false;
                }else if(responseText == 'visualcaptcha_error'){
                    form.parents('.pccf').data('vcaptcha').refresh();
                    form.parents('.pccformwrapper').find('.submitting').fadeOut(function(){
                        $PC('<div style="display:none;" class="alert alert-warning" role="alert">Captcha validation failed, please try again.</div>')
                            .prependTo(form).fadeIn().delay(4000).fadeOut(function() {
                                $PC(this).parents('.pcform_bottom_right,.pcform_bottom_left').each(function() {
                                    slideOutResize($PC(this));
                                })
                            });
                        ;
                    });
                    return false;
                }else{
                    window['PCCF' + form.closest('.pccf').attr('formid') + 'SubmitJS']();
                    var fwrap = form.parents('.pccformwrapper');
                    fwrap.css({height:fwrap.height()+'px',width:fwrap.outerWidth()+'px'});
                    fwrap.children().fadeOut(function() {
                        fwrap.children().remove();
                        fwrap.html(responseText);
                        fwrap.children().fadeIn();
                    });
                }
            }
        });
    })

    $PC('.pccform .input-group,.pccform .checkbox-inline,.pccform .checkbox,.pccform .radio-inline,.pccform .radio').bind("DOMSubtreeModified",function(){
        $PC(this).find('.validation-advice').insertAfter(this);
    });

    //resize slideout forms once more
    $PC('.pcform_bottom_left,.pcform_bottom_right').each(function() {
        slideOutResize($PC(this),true);
    });

    //dependent fields
    initPCCFDependentFields();

    initPCCFResize();

}

/**
 * Initializes form upload element
 */
function initPCCFUploadFields() {
    if(!$PC('.pcc_upload').length){
        return;
    }

    head.load(PCCBaseJSURL + "contactforms/upload.js",function() {
        //init upload fields
        $PC('.pcc_upload').each(function() {
            var uploadText = $PC(this).find('.fs-upload-target').text();
            $PC(this).find('.fs-upload-target').remove();
            var parentId = $PC(this).parents('.pccf').attr('formid');
            var uniqId = $PC(this).parents('.pccf').find('.pcc_uid').val();
            var index = $PC(this).parents('.pccf').find('.pcc_upload').index($PC(this));
            jQuery(this).upload({
                action: PCCFileUploadUrl + 'form_id/' + parentId + '/uid/' + uniqId + '/index/' + index + '/',
                label: uploadText
            }).on("start.upload", PCCFUploadOnStart)
                .on("complete.upload", PCCFUploadOnComplete)
                .on("filestart.upload", PCCFUploadOnFileStart)
                .on("fileprogress.upload", PCCFUploadOnFileProgress)
                .on("filecomplete.upload", PCCFUploadOnFileComplete)
                .on("fileerror.upload", PCCFUploadOnFileError);
        });
        $PC('.pcc_upload').each(function() {
            if($PC(this).closest('.form-group').hasClass('required-control')){
                $PC(this).find('input').addClass('required-entry');
            };
        });
    });
}

/**
 * Loads date picker libraries
 *
 * @returns {boolean}
 */
function initPCCFDate() {
    if(!PCCFDate) {
        return false;
    }

    head.load(PCCBaseJSURL + "contactforms/lib/datetime/moment.min.js",function() {
            head.load(
                [
                    PCCBaseJSURL + "contactforms/lib/datetime/bootstrap-datetimepicker.min.css",
                    PCCBaseJSURL + "contactforms/lib/datetime/collapse-transitions.min.js",
                    PCCBaseJSURL + "contactforms/lib/datetime/bootstrap-datetimepicker.min.js"
                ],
                function() {
                    initPCCFDateElements();
                }
            );
        }
    )
}

/**
 * Initializes date picker elements
 */
function initPCCFDateElements() {
    //date & time
    $PC('.pccf .date.dateandtime').datetimepicker({
        allowInputToggle: true,
        sideBySide:true,
        widgetPositioning: {horizontal:'right'}
    });
    //only date
    $PC('.pccf .date.dateonly').datetimepicker({
        allowInputToggle: true,
        format:'L'
    });
    //only time
    $PC('.pccf .date.time').datetimepicker({
        format: 'LT',
        allowInputToggle: true
    });
    //date range
    $PC('.pccf .date.daterange').datetimepicker({
        allowInputToggle: true,
        format:'L'
    });
    $PC('.pccf .date.daterange.datestart').on("dp.show", function (e) {
        var maxDateObj = $PC(e.target).parent().parent().next().find('.dateend').data("DateTimePicker");

        if(maxDateObj && maxDateObj.date()){
            //set max date according to date end value
            $PC(e.target).data('DateTimePicker').maxDate(maxDateObj.date());
            //set min date according to max days parameter
            var max_days = $PC(this).attr("max_days");
            if (typeof max_days != "undefined" && max_days) {
                $PC(e.target).data('DateTimePicker').minDate(maxDateObj.date().subtract(max_days, "day"));
            }
        }
    });

    $PC('.pccf .date.daterange.dateend').on("dp.show", function (e) {
        var minDateObj = $PC(e.target).parent().parent().prev().find('.datestart').data("DateTimePicker");
        if(minDateObj && minDateObj.date()){
            //set min date according to date start value
            $PC(e.target).data('DateTimePicker').minDate(minDateObj.date());
            //set max date according to max days parameter
            var max_days = $PC(this).attr("max_days");
            if (typeof max_days != "undefined" && max_days) {
                $PC(e.target).data('DateTimePicker').maxDate(minDateObj.date().add(max_days, "day"));
            }
        }
    })
}

/**
 * Initializes visual captcha
 */
function initPCCFCaptcha() {
    if(!$PC('.vcaptcha').length){
        return;
    }
    head.load(PCCBaseJSURL + "contactforms/lib/visualcaptcha/js/visualcaptcha.jquery.js",function() {
        var i = 0;
        $PC( '.vcaptcha').each(function() {
            $PC(this).parents('form.pccform').append('<input type="hidden" name="vcaptcha_namespace" value="namespace' + i +'" />');
            var captchaEl = jQuery(this).visualCaptcha({
                imgPath: PCCBaseJSURL + 'contactforms/lib/visualcaptcha/img/',
                url: PCCFVisualCaptchaUrl,
                captcha: {
                    numberOfImages: 5,
                    routes: {
                        start: 'startvcaptcha/vcaptcha_namespace/namespace' + i + '/count',
                        image: 'imagevcaptcha/vcaptcha_namespace/namespace' + i +'/index',
                        audio: 'audiovcaptcha/vcaptcha_namespace/namespace' + i
                    }
                }
            } );
            var captcha = captchaEl.data( 'captcha' );
            $PC(this).parents('.pccf').data('vcaptcha', captcha);
            i++;
        })
    });
    head.load(PCCBaseJSURL + "contactforms/lib/visualcaptcha/css/visualcaptcha.css");
}

/**
 * Initializes reCaptcha functionality
 */
function initPCCFReCaptcha(){
//write recaptcha api js
    if(typeof grecaptcha == "undefined"){
        $PC('body').append("<script " + "src='https://www.google.com/recaptcha/api.js?render=explicit' async defer><\/script>");
    }
    //wait until loaded before initiating captchas
    var initReCaptcha = setInterval(function(){
        if(typeof grecaptcha != "undefined"){
            clearInterval(initReCaptcha);
            initPCCFReCaptchaElements();
        }
    },50)
}

/**
 * Initializes or re-initializes reCaptcha elements
 */
function initPCCFReCaptchaElements(){
    if(typeof grecaptcha != "undefined") {
        $PC('.pccf .g-recaptcha').each(function () {
            try {
                $PC(this).before('<div class="g-recaptcha" />');
                var newCaptcha = $PC(this).prev();
                $(this).remove();
                grecaptcha.render(newCaptcha[0], {sitekey: RECAPTCHA_PUBLIC_KEY})
            } catch (err) {
            }
        });
        $PC('.pcform_bottom_right,.pcform_bottom_left').each(function () {
            slideOutResize($PC(this), true);
        })
    }
}

/**
 * Initializes colorbox pop-up form functionality
 */
function pccfLightbox() {
    //load lightbox
    if(typeof jQuery.colorbox == 'undefined'){
        head.load(PCCBaseJSURL + 'contactforms/lib/colorbox/colorbox.css');
        head.load(PCCBaseJSURL + 'contactforms/lib/colorbox/colorbox.js',function() {
            jQuery(".pccflightbox").each(function() {
                var width = '600px';
                if(jQuery(this).attr('popupminwidth')){
                    width = jQuery(this).attr('popupminwidth');
                }
                jQuery(this).colorbox({
                    inline: true, width: width, maxWidth: '95%', onComplete: function () {
                        initPCCFReCaptchaElements();
                        PCCFExecuteResize();
                    }
                })
            });
        })
    }else{
        //ultimo theme
        jQuery(".pccflightbox").each(function() {
            var width = '600px';
            if(jQuery(this).attr('popupminwidth')){
                width = jQuery(this).attr('popupminwidth');
            }
            jQuery(this).colorbox({
                inline: true, width: width, maxWidth: '95%', close: '', onComplete: function () {
                    initPCCFReCaptchaElements();
                    PCCFExecuteResize();
                }
            })
        });
    }
    //resize colorbox if submitted, because validation message takes space
    $PC('.pccf button[type="submit"]').on('click',function() {
        if($PC(this).parents('#colorbox').length){
            setTimeout(function() {
                jQuery.colorbox.resize();
            },50)
        }
    })
}

/**
 * Shows slide-out form
 *
 * @param position
 * @param animation
 * @param element
 * @param size
 */
function showPCForm(position,animation,element,size){
    var element = $PC(element).parent();
    var position = position;
    var animation = animation;
    var size = size;
    var isvertical = false;

    if(size == 'ownheight'){
        size = $PC(element).height();
        isvertical = true;
    }

    //adjust width based on viewport
    if($PC( document ).width() < 530){
        //mobile view
        if(!isvertical) {
            size = $PC(document).width();
        }
        element.css('width', $PC(document).width() + 'px');
        element.prepend('<img class="pccf-slide-out-close" src="' + PCCBaseJSURL + 'contactforms/img/x.png" onclick="showPCForm(\'' + position + "','" + animation + "',this,500)\" />")
    }else{
        //desktop / tablet view
        element.css('width', '500px');
        size = 500;
    }



    if(element.hasClass('expanded')){
        element
            .removeClass('expanded ' + animation)
            .addClass('animated ' + animation.replace('In','Out').replace('Up','Down'))
        ;
        setTimeout(function(){
            element
                .fadeOut(0)
                .removeClass('animated ' + animation.replace('In','Out').replace('Up','Down'))
                .fadeIn('fast')
                .css(position, '-' + size + 'px');
        },1000);
    }
    else{
        element.fadeOut('fast',function(){
            element.addClass('expanded animated ' + animation).fadeIn(0).css(position,'-0px')
            setTimeout(function() {
                element.removeClass('animated ' + animation);
                element.removeClass('expanded');
                setTimeout(function() {
                    element.addClass('expanded');
                    initPCCFReCaptchaElements();
                },10)
            },1200)
        });
    }
}

/*
* initialize animate.css library if not loaded yet
*/

function initPCCFanimateCSS(){
    if(typeof BrowserIE9 != "undefined"){
        return;
    }
    var dummyAnimateCss = $PC('<dummy class="animated" style="display:none;"/>').appendTo('body');
    var animateCssLoaded = dummyAnimateCss.css('animation-duration');
    dummyAnimateCss.remove();
    if(!animateCssLoaded || animateCssLoaded == '0s') {
        head.load(PCCBaseJSURL + "lib/animate.min.css");
    }
}

/**
 * Initialize Multi-page contact form pages
 */
function initPCCFPages(){
    $PC('.pccf fieldset').each(function(){
        var form = $PC(this);
        if(form.find('.formpage').length < 1){
            return;
        }
        $PC(document).keydown(function (event) {
            if (event.keyCode == 13 && $PC(event.target).parents('.formpage').length && !$PC(event.target).is('textarea')) {
                event.preventDefault();
                return false;
            }
        });

        if($PC(this).parents('.pcform_bottom_right,.pcform_bottom_left').length){
            $PC(this).css({
                '-webkit-transition': 'all 0s',
                '-moz-transition': 'all 0s',
                '-o-transition': 'all 0s',
                '-ms-transition': 'all 0s',
                'transition': 'all 0s'
            })
        }
        initPCCFanimateCSS();

        $PC(this).css({
            'clear': 'both',
            'position': 'relative'
        });

        if(!form.children().eq(0).is('.formpage')){
            form.prepend('<div class="formpage" pagetitle="page 1" nexttext="Next" />');
        }

        form.parent().prepend('<ul class="nav-wizard" />');

        form.children('.formpage').each(function(){
            $PC(this).removeClass('form-group').html('');
            $PC(this).append($PC(this).nextUntil('.formpage'));

            $PC(this).parents('.pccf').find('.nav-wizard').append('<li><a>' + $PC(this).attr('pagetitle') + '</a></li>');

            var prevNext = $PC('<div class="form-group"><div class="col-md-offset-3 col-md-6 navbuttons"></div></div>');
            var navb = prevNext.find('.navbuttons');
            navb.append('<div style="margin-left:10px;float:right;"><button style="float:right;" onclick="PCCFnextPage(this)" type="button" class="next btn btn-primary">' + $PC(this).attr('nexttext') + '</button></div>');
            if($PC(this).attr('prev') == 1){
                navb.append('<button style="float:right;" onclick="PCCFprevPage(this)" type="button" class="prev btn btn-default">' + $PC(this).attr('prevtext') + '</button>');
            }
            $PC(this).append(prevNext);
        })

        form.children('.formpage').last().find('.next').remove();
        form.children('.formpage').first().find('.prev').remove();
        form.parent().find('.nav-wizard li').eq(0).addClass('active');

        if(typeof BrowserIE9 != "undefined"){
            form.find('.formpage').hide();
            form.find('.formpage').first().show();
        }
    })
}

function PCCFToggleNavType(){
    //adjust pager items based on form width
    jQuery('.pccf').each(function(){
        var useSmallNav = false;
        jQuery(this).removeClass('smallnav');
        jQuery(this).find('.nav-wizard > li').each(function () {
            if (!jQuery(this).is("li:first-child")) {
                if (jQuery(this).offset().top > jQuery(this).prev().offset().top) {
                    useSmallNav = true;
                }
            }
        });
        if(useSmallNav){
            jQuery(this).addClass('smallnav');
        }else{
            jQuery(this).removeClass('smallnav');
        }
    })
}

/**
 * Next page functionality for multi-page forms
 *
 * @param element
 * @returns {boolean}
 * @constructor
 */
function PCCFnextPage(element){
    var form = $PC(element).parents('.pccf');
    if(form.find('.animated').length){
        return;
    }
    if(!form.attr('curpage')){
        form.attr('curpage', 1);
    }

    var validated = true;
    $PC(element).parents('.formpage').find('input,select,textarea').each(function () {
        var eId = $PC(this).attr('id');
        if(eId){
            if(!Validation.validate($(eId))){
                validated = false;
            }
        }
    });

    if(!validated){
        if($PC(this).parents('#colorbox').length){
            setTimeout(function(){
                jQuery.colorbox.resize();
            },50)
        }
        return false;
    }

    var curPage = parseInt(form.attr('curpage'));
    var curIndex = curPage - 1;

    var curPageEm =  form.find('.formpage').eq(curIndex);
    var nextPageEm =  form.find('.formpage').eq(curPage);

    form.attr('curpage', curPage + 1);

    form.find('.nav-wizard li.active').removeClass('active');
    form.find('.nav-wizard li').eq(curIndex + 1).addClass('active');

    form.css('overflow','hidden');
    var fieldset = form.find('fieldset');
    fieldset.css('height',fieldset.height()+'px');

    curPageEm.addClass('animated fadeOutLeft anipage');
    nextPageEm.addClass('animated fadeInRight').show();

    nextPageEm.wrap('<fieldset />');
    var newHeight = nextPageEm.parent().outerHeight() + 'px';
    nextPageEm.unwrap();

    fieldset.css('height', newHeight);

    if($PC(element).closest('#colorbox').length){
        var cnt = 0;
        var timer = setInterval(function(){
            jQuery.colorbox.resize();
            cnt++;
            if(cnt > 3){
                clearInterval(timer);
            }
        },100);
    }

    var timeout = 1200;
    if(typeof BrowserIE9 != "undefined"){
        timeout = 0;
    }

    setTimeout(function () {
        curPageEm.removeClass('animated fadeOutLeft anipage');
        curPageEm.hide();
        nextPageEm.removeClass('animated fadeInRight');
        fieldset.css('height','auto');
        form.css('overflow','');
        initPCCFReCaptchaElements();
    }, timeout);
}

/**
 * Prev page functionality for multi-page forms
 *
 * @param element
 * @constructor
 */
function PCCFprevPage(element){
    var form = $PC(element).parents('.pccf');
    if(form.find('.animated').length){
        return;
    }
    var curPage = parseInt(form.attr('curpage'));
    var curIndex = curPage - 1;

    var curPageEm =  form.find('.formpage').eq(curIndex);
    var prevPageEm =  form.find('.formpage').eq(curIndex - 1);

    form.attr('curpage', curPage - 1);

    form.find('.nav-wizard li.active').removeClass('active');
    form.find('.nav-wizard li').eq(curIndex - 1).addClass('active');

    form.css('overflow','hidden');

    var fieldset = form.find('fieldset');
    fieldset.css('height',fieldset.height()+'px');

    curPageEm.addClass('animated fadeOutRight anipage');
    prevPageEm.addClass('animated fadeInLeft').show();

    prevPageEm.wrap('<fieldset />');
    var newHeight = prevPageEm.parent().outerHeight() + 'px';
    prevPageEm.unwrap();
    fieldset.css('height', newHeight);

    if($PC(element).closest('#colorbox').length){
        var cnt = 0;
        var timer = setInterval(function(){
            jQuery.colorbox.resize();
            cnt++;
            if(cnt > 3){
                clearInterval(timer);
            }
        },100)
    }

    var timeout = 1200;
    if(typeof BrowserIE9 != "undefined"){
        timeout = 0;
    }

    setTimeout(function () {
        curPageEm.removeClass('animated fadeOutRight anipage');
        curPageEm.hide();
        prevPageEm.removeClass('animated fadeInRight');
        form.css('overflow','');
        initPCCFReCaptchaElements();
    }, timeout);
}

/**
 * Initialize depended fields functionality
 */
function initPCCFDependentFields(){
    if(PCCFDependentFields.length == 0){
        return;
    }

    head.load(PCCBaseJSURL + 'contactforms/lib/dependsOn.js',function() {
        //var dFormIds = PCCFarrayUnique(PCCFDependentFields);
        var dFormIds = jQuery.makeArray(jQuery(PCCFDependentFields).filter(function(i,itm){
            // note: 'index', not 'indexOf'
            return i == jQuery.inArray(itm,PCCFDependentFields);
        }));

        jQuery.each(dFormIds,function(k,formId){
            jQuery('.pccf[formid=' + formId + ']').each(function(){
                var form = $PC(this);
                var increment = form.find('form').attr('id').replace('pccf_','');
                var dfields = JSON.parse(form.find('.dependent_fields').text());

                //set option values
                form.find('option').each(function(){
                   if(!jQuery(this).attr('value') && jQuery(this).attr('value') != ""){
                       jQuery(this).attr('value',jQuery(this).text());
                   }
                });

                $PC.each(dfields,function(fKey,fValue){
                    var dependencies = {};
                    $PC.each(fValue.dependencies,function(dKey,dValue){
                        switch(dValue.fieldType){
                            case 'dropdown':
                            case 'multiple':
                                var selector = '#' + dValue.field + increment;
                                var deps = {};
                                var values = dValue.value;
                                values = [values];
                                deps[dValue.condition] = values;
                                dependencies[selector] = deps;
                                break;
                            case 'text':
                                var selector = '#' + dValue.field + increment;
                                var deps = {};
                                var values = dValue.value.split(';;');
                                deps[dValue.condition] = values;
                                dependencies[selector] = deps;
                                break;
                            case 'checkboxes':
                                var selector = 'input[name="' + dValue.field + increment + '[]"]';
                                var deps = {};
                                var values = dValue.value;
                                values = [values];
                                deps[dValue.condition] = values;
                                dependencies[selector] = deps;
                                break;
                            case 'radios':
                                var selector = 'input[name=' + dValue.field + increment + ']';
                                var deps = {};
                                var values = dValue.value;
                                values = [values];
                                deps[dValue.condition] = values;
                                dependencies[selector] = deps;
                                break;
                        }
                    });
                    if(!jQuery.isEmptyObject(dependencies)){
                        var em = form.find('label[for=' + fValue.name + increment + ']').parent();
                        if(!em.length){
                            em = form.find('#' + fValue.name + increment).closest('.row');
                        }
                        em.dependsOn(dependencies);
                    }
                });
            });
        });
    });
}

/**
 * Generates random string
 *
 * @returns {string}
 * @constructor
 */
function PCs4() {
    return Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);
}

/**
 * Generates random ID
 *
 * @returns {string}
 * @constructor
 */
function PCRandId() {
    return PCs4() + PCs4();
}

/**
 * intializes resize functionality for slide-out forms
 * Also toggles nav menu type on resize
 */
function initPCCFResize(){
    $PC( window ).resize(function() {
        PCCFStartResize();
    });
}

function PCCFStartResize(){
    if(pc_resizing) {
        return false;
    }
    pc_resizing = true;
    setTimeout(function(){
        PCCFExecuteResize();
        setTimeout(function() {
            pc_resizing = false;
            PCCFExecuteResize();
        },1500)
    },200);
}

function PCCFExecuteResize(){
    //toggle navigation menu type
    PCCFToggleNavType();
    if(typeof jQuery.colorbox != "undefined"){
        jQuery.colorbox.resize();
    }

    //resize slide out forms
    $PC('.pcform_bottom_left,.pcform_bottom_right').each(function () {
        slideOutResize($PC(this),true);
    });
}

/**
 * Initializes RTL functionality
 */
function initPCCFRTL(){
    //set direction to rtl
    $PC('.pccf.rtl').css('direction','rtl');
    //modify all elements to rtl
    $PC('.pccf.rtl').find('*').each(function(){
        var el = $PC(this);
        var mLeft = el.css('margin-left');
        var mRight = el.css('margin-right');
        var pLeft = el.css('padding-left');
        var pRight = el.css('padding-right');
        var borderBL = el.css('border-bottom-left-radius');
        var borderTL = el.css('border-top-left-radius');
        var borderBR = el.css('border-bottom-right-radius');
        var borderTR = el.css('border-top-right-radius');

        if(el.css('float') == 'right'){
            el[0].style.setProperty('float','left','important');
        }else if(el.css('float') == 'left'){
            el[0].style.setProperty('float','right','important');
        }

        el[0].style.setProperty('margin-left',mRight,'important');
        el[0].style.setProperty('margin-right',mLeft,'important');
        el[0].style.setProperty('padding-left',pRight,'important');
        el[0].style.setProperty('padding-right',pLeft,'important');
        el[0].style.setProperty('border-bottom-left-radius',borderBR,'important');
        el[0].style.setProperty('border-bottom-right-radius',borderBL,'important');
        el[0].style.setProperty('border-top-left-radius',borderTR,'important');
        el[0].style.setProperty('border-top-right-radius',borderTL,'important');

        if(el.is('label')){
            el[0].style.setProperty('text-align','left','important');
        }
        if(el.is('.radio-inline') || el.is('.radio') || el.is('.checkbox-inline') || el.is('.checkbox') || el.is('button')){
            el[0].style.setProperty('float','right','important');
        }
        if(el.is('.help-block')){
            el[0].style.setProperty('text-align','right','important');
        }
        if(el.attr('class') && el.attr('class').match(/col\-/g)){
            el[0].style.setProperty('float','right','important');
        }
    })
}

/**
 * Parses version string. Used to check loaded jQuery version
 *
 * @param str
 * @returns {*}
 * @constructor
 */
function PCCFparseVersionString(str){
    if (typeof(str) != 'string') { return false; }
    var x = str.split('.');
    // parse from string or default to 0 if can't parse
    var maj = parseInt(x[0]) || 0;
    var min = parseInt(x[1]) || 0;
    var pat = parseInt(x[2]) || 0;
    return {
        major: maj,
        minor: min,
        patch: pat
    }
}

/**
 * Checks if min version is matched
 * Used for jQuery checking
 *
 * @param vmin
 * @param vcurrent
 * @returns {boolean}
 * @constructor
 */
function PCCFCheckMinVersion(vmin, vcurrent) {
    var minimum = PCCFparseVersionString(vmin);
    var running = PCCFparseVersionString(vcurrent);
    if (running.major != minimum.major)
        return (running.major > minimum.major);
    else {
        if (running.minor != minimum.minor)
            return (running.minor > minimum.minor);
        else {
            if (running.patch != minimum.patch)
                return (running.patch > minimum.patch);
            else
                return true;
        }
    }
};

/**
 * Returns array of unique values
 *
 * @param array
 * @returns {*}
 * @constructor
 */
function PCCFarrayUnique(array){
    return array.filter(function(el, index, arr) {
        return index === arr.indexOf(el);
    });
}