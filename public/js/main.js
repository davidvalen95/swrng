

$(document).ready(function(){
    var url = $('#data-global').data('url');
    var options = {

        url: url + "/api/list/city",

        getValue: "name",

        list: {
            match: {
                enabled: true
            }
        },

        // theme: "square"
    };

    $("#city").easyAutocomplete(options);
    $("#targetCity").easyAutocomplete(options);

    $(".easy-autocomplete").css('width','100%');

    $('.image-link').magnificPopup({type:'image'});
    // $(".easy-autocomplete").css('width','100%');
})