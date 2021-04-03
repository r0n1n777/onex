$('.confirmation').on("click", function(){
    $('.id').val($(this).attr('id'));
    $('.name').html($(this).attr('name'));
    $('.phone').html($(this).attr('phone'));
    $('.email').html($(this).attr('email'));
    $('.date').html($(this).attr('date'));
});
