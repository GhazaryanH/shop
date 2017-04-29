$(document).ready(function () {
    $('.add_buy').click(function () {
        id = $(this).data().index;
        $.ajax({
            url: 'buy.php',
            type: 'post',
            dataType: 'json',
            data: ({id:id}),
            success: (function (data) {
                if(data != 1) {
                    if(data['first'] == 'yes'){
                        $('.order_cont').html('<div class="orders panel panel-default all_shops"><div class="panel-heading"><span>Your order</span><i class="fa fa-times removing" data-index="0" aria-hidden="true"></i><i class="fa fa-minus shops" data-section="minimize" aria-hidden="true"></i></div><div class="panel-body"></div><div class="panel-footer">Total sum - <span class="all_total"></span> $</div><button class="form-control btn-success buy">Buy</button></div>');
                    }
                    options = "";
                    for (i = 1; i <= data['count']; i++) {
                        options += "<option value='" + i + "'>" + i + "</option>";
                    }
                    document.getElementsByClassName('panel-body')[0].innerHTML += "<div class='panel-body' style='border-top: 1px solid silver;'><div class='row'><div class='col-lg-5'><p>" + data['name'] + "</p><img class='order_img' src='images/" + data['id'] + '/' + data['source'] + "'></div><div class='col-lg-7'><p>" + data['price'] + " $ - Price</p><select class='counts' data-index='" + data['id'] + "'><option>1</option>" + options + "</select><span> - Count</span><p style='margin-bottom: 0;'><span class='this_total'>" + data['price'] + "</span> $ - Total sum</p><button data-index='"+data['id']+"' class='btn-danger removing'>Remove</button></div></div></div>";
                    $('.all_total').text(data['total']);
                }else{
                    alert("This product is already in your order.");
                }
            })
        })
    });
    $(document).on('click', '.shops', function () {
        section = $(this).data().section;
        $('.all_shops').fadeToggle();
        $.ajax({
            url: 'shop.php',
            type: 'post',
            data: ({section:section})
        })
    });
    $(document).on('click', '.removing', function () {
        id = $(this).data().index;
        this_ = $(this).parent().parent().parent();
        $.ajax({
            url: 'delete.php',
            type: 'post',
            data: ({id:id}),
            success: (function (data) {
                if(data != 'all'){
                    this_.fadeOut();
                    this_.html('');
                    $('.all_total').text(data);
                }else{
                    $('.order_cont').html('');
                }
            })
        })
    });
    $(document).on('change', '.counts', function () {
        this_total = $(this).parent().parent().parent().find('.this_total');
        id = $(this).data().index;
        count = $(this).val();
        $.ajax({
            url: 'count.php',
            type: 'post',
            dataType: 'json',
            data: ({id:id, count:count}),
            success: (function (data) {
                this_total.text(data['this']);
                $('.all_total').text(data['total']);
            })
        })
    });
    $('.add_money').click(function () {
        val = $('.money').val();
        $.ajax({
            url: 'money.php',
            type: 'post',
            data: ({val:val}),
            success: (function (data) {
                $('.my_money').html(data);
                $('.money').val('');
            })
        })
    });
    $(document).on('click', '.buy', function () {
        val = $(this).parent().find('.all_total').text();
        $.ajax({
            url: 'order_buy.php',
            type: 'post',
            data: ({val:val}),
            success: (function (data) {
                if(data == false){
                    alert('Pls Login')
                }else{
                    window.location.assign('buy_page.php');
                }
            })
        })
    });
    $(document).on('click', '.last_buy', function () {
        $.ajax({
            url: 'last_buy.php',
            type: 'post',
            success: (function (data) {
                if(data == 'money'){
                    alert('Not enough money')
                }else{
                    window.location.assign('profile.php');
                }
            })
        })
    });
});