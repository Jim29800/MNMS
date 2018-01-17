$(document).ready(function () { 
    $(".room-need").hide();
    $(".room-new").hide();
    $(".room-all").hide();
});

$("#btn-room-new").click(function() {
    $("form :input").val("");
    $('input[type=checkbox]').prop('checked', false);
    
    $("#appbundle_room_NeedPlace").prop("checked", false);
    $(".room-need").hide();    
    $(".room-new").show();
    $(".room-all").show();
    
})
$("#btn-room-need").click(function () {
    $("form :input").val("");
    $('input[type=checkbox]').prop('checked', false);

    $("#appbundle_room_NeedPlace").prop("checked", true);    
    $(".room-need").show();
    $(".room-new").hide();
    $(".room-all").show();
    
})

