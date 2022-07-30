$(".25565").on('click', function() {
    $('.inpPort').val('25565');
});
$('.27015').on('click', function() {
    $('.inpPort').val('27015');
});
$('.8621').on('click', function() {
    $('.inpPort').val('8621');
});
$('.80').on('click', function() {
    $('.inpPort').val('80');
});
$('.7777').on('click', function() {
    $('.inpPort').val('7777');
});
$('.27016').on('click', function() {
    $('.inpPort').val('27016');
});
$('.8080').on('click', function() {
    $('.inpPort').val('8080');
});

function checkPortTab(){
    let ipv4 = $('.inpPort').val();
        console.log( ipv4);
    const exp = (/[0-9]{2,10000}/g);
    ipv4 =  Number(ipv4.search(exp));
    if(ipv4 == -1){
        $('#outputPort').html('Введите корректный порт');
        return false;
    } else {
   return true;
    }
};
