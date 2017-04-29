$(document).ready(function () {
   $('.edit_but').click(function () {
       $('.modal').fadeToggle();
       data = $(this).data();
       id = data.index;
       eng = $(this).parent().parent().find('.eng').text();
       rus = $(this).parent().parent().find('.rus').text();
       $('.eng_ed').val(eng);
       $('.rus_ed').val(rus);
       $('.hid').val(id);
   });
    $('.close_modal').click(function () {
        $('.modal').fadeToggle();
    });
    array = [];
    $('.cbox').click(function () {
        data = $(this).data();
        id = data.index;
        num = array.indexOf(id);
        row = $(this).parent().parent();
        if(num >= 0) {
            array.splice(num);
            row.removeClass('deleting');
        }else {
            array.push(id);
            row.addClass('deleting');
        }
        if(array.length > 0){
            $('.del').fadeIn();
        }else{
            $('.del').fadeOut();
        }
        ids = array.join(',');
    });
    $('.del').click(function () {
        data = $(this).data();
        section = data.section;
        $('.modal-body').html("<button class='del_yes btn-success form-control'>Yes</button>");
        $('.modal').fadeToggle();
    });
    $('body').on('click', '.del_yes', function () {
        $.ajax({
            url: 'delete.php',
            type: 'post',
            data: ({ids:ids, section:section}),
            success: (function () {
                $('.deleting').fadeOut();
                $('.modal').fadeOut();
                $('.del').fadeOut();
                array = [];
            })
        })
    });
    $('.add_slide').click(function () {
        id = $(this).data().index;
        this_ = $(this);
        $.ajax({
            url: 'slider.php',
            type: 'post',
            data: ({id:id}),
            success: (function () {
                this_.toggleClass('btn-primary');
                this_.toggleClass('btn-danger');
            })
        })
    });
    for(i = 1; i < 100; i++){
        document.getElementsByClassName('sale_sel')[0].innerHTML += '<option value="'+i+'">'+i+'%</option>';
    }
    $('.photos').click(function () {
        $('.photos').css({'border': '0', 'opacity': '0.75'});
        data = $(this).data();
        id = data.index;
        this_ = $(this);
        $.ajax({
            url: 'main_img.php',
            type: 'post',
            data: ({id:id}),
            success: (function (data) {
                if(data == 1){
                    this_.css({'border': '0', 'opacity': '0.75'});
                }else if(data == 2){
                    this_.css({'border': '2px solid red', 'opacity': '1'});
                }
            })
        })
    });
    $('.del_img').click(function () {
        data = $(this).parent().find('.photos').data();
        id = data.index;
        this_ = $(this).parent();
        $.ajax({
            url: 'del_img.php',
            type: 'post',
            data: ({id:id}),
            success: (function () {
                this_.css({'display': 'none'});
            })
        })
    });
});