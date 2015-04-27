$(function(){

    var current_url = location.pathname;

    $('#articleform-title').on('input', function(){
        var title = $(this).val();
        var preview_title = $('#preview_title');
        preview_title.text(title);
    });
    $('#articleform-description').on('input', function(){
        var description = $(this).val();
    });

    //preview article with validation on AJAX
    $('#preview-btn').on('click', function(){
        var url = $(this).attr('href');
        var o = $('#create-article-form').serialize();
        $.post(url,o).done(function(response){
            var data = $.parseJSON(response);
            if(data.status == 'error') {
                var error = '';
                for (var i in data.errors) {
                    $('.field-articleform-'+i+'  .help-block').text(data.errors[i]);
                    $('.field-articleform-'+i).removeClass('has-success').addClass('has-error');
                }
            }else{
                location.replace(data.url);
            }
        });
        return false;
    });

    //login user with validation on AJAX
    $(document).on('click', '#login-btn', function(){
        var url = $(this).closest('form').attr('action');
        var o = $('#modal-login-form').serialize();
        $.post(url,o).done(function(response){
            var data = $.parseJSON(response);
            if(data.status == 'error') {
                var error = '';
                for (var i in data.errors) {
                    $('.field-loginform-'+i+' .help-block').text(data.errors[i]);
                    $('.field-loginform-'+i).removeClass('has-success').addClass('has-error');
                }
            }else{
                location.replace(data.url);
            }
        });
        return false;
    });

    //login user with validation on AJAX
    $(document).on('click', '#sign-up-btn', function(){
        var url = $(this).closest('form').attr('action');
        var o = $('#modal-registration-form').serialize();
        $.post(url,o).done(function(response){
            var data = $.parseJSON(response);
            if(data.status == 'error') {
                var error = '';
                for (var i in data.errors) {
                    $('.field-registrationform-'+i+' .help-block').text(data.errors[i]);
                    $('.field-registrationform-'+i).removeClass('has-success').addClass('has-error');
                }
            }else{
                location.replace(data.url);
            }
        });
        return false;
    });

    //modals
    $('.modal-btn').on('click', function(){
        var url = $(this).attr('href');
        var modal_type = $(this).attr('data-modal-type');
        $.get(url,{'modal':modal_type}).done(function(response){
            var data = $.parseJSON(response);
            $('body').append(data.view);
            $('#'+modal_type+'Modal').arcticmodal({
                beforeOpen: function(data, el) {
                    $('.wrap').css('-webkit-filter','blur(5px)');
                },
                afterClose: function(data, el) {
                    $('.wrap').css('-webkit-filter','');
                    $('#'+modal_type+'Modal').remove();
                },
                overlay: {
                    css: {
                        backgroundColor: 'rgb(0, 0, 0)',
                        opacity: .65
                    }
                }
            });
        });
        return false;
    });

    if(current_url.match('/create-article/')){
        //CKEDITOR toolbar configuration
        CKEDITOR.config.toolbar =
            [
                { name: 'styles', items : [ 'Styles','Format' ] },
                { name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
                { name: 'clipboard', items: [ 'Undo', 'Redo' ] }
            ];
    }


    /* var rightBtnHeight = $('.button-list').height();
    var writeArticle = $('.write-article').offset().top;
    var earnMoney = $('.earn-money').offset().top-rightBtnHeight;
    var buyArticle = $('.buy-article').offset().top-rightBtnHeight*2;
    var join = $('.join').offset().top-rightBtnHeight*3;
    //scroll section
    $(document).on('scroll', function(){
        var scrollH = $(document).scrollTop();
        console.log('window: '+scrollH);
        console.log('btn: '+writeArticle);
        if(scrollH > writeArticle){
            $('.write-article').addClass('fixed-right-btn');
        }else{
            $('.write-article').removeClass('fixed-right-btn');
        }
        if(scrollH > earnMoney){
            $('.earn-money').addClass('fixed-right-btn');
        }else{
            $('.earn-money').removeClass('fixed-right-btn');
        }
        if(scrollH > buyArticle){
            $('.buy-article').addClass('fixed-right-btn');
        }else{
            $('.buy-article').removeClass('fixed-right-btn');
        }
        if(scrollH > join){
            $('.join').addClass('fixed-right-btn');
        }else{
            $('.join').removeClass('fixed-right-btn');
        }
        $('.button-list').each(function(){
            if($(this).offset().top < scrollH){
                $(this).addClass('fixed-right-btn');
                console.log(' btn - '+$(this).attr('class')+' -> '+$(this).offset().top);
            }else{
                $(this).removeClass('fixed-right-btn');
            }
        });
    });*/

    //appear-disappear footer
    $('.arrow-footer').on('click', function(){
        var isShow = $(this).hasClass('open');
        if(isShow){
            $(this).removeClass('open');
            $('.footer').removeClass('open');
            $('.arrow-footer').removeClass('pull-right glyphicon-remove').addClass('glyphicon-chevron-up');
        }else{
            $(this).addClass('open');
            $('.footer').addClass('open');
            $('.arrow-footer.glyphicon').addClass('glyphicon-remove pull-right').removeClass('glyphicon-chevron-up');
        }
    });
    //tooltip
    //$('[data-toggle="tooltip"]').tooltip();
});
