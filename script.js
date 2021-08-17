//Script for index memory image mgmt
$(document).ready(function(){

    $("#hidebtn").click(function(){
        $("#hide").toggle("200");
        if($('#hidebtn').val() === 'Hide Memory Pic'){
            $('#hidebtn').val("Show Memory Pic");
        }else{
            $('#hidebtn').val("Hide Memory Pic");
        }
    });
})

//Script for memory image bouncing

var isBouncing = false;

var bounceMemory = function() {
if (isBouncing) {
    alert("Memory Picture bouncing! Stop it!");
    $("#hide").removeClass("animate__heartBeat");
    isBouncing = false;
    $('#bounceButton').html("Bounce Memory");
} else {
    
    $("#hide").addClass("animate__heartBeat");
    isBouncing = true;
    $('#bounceButton').html("Stop it!");
}
}

//toggle after memory select

$(document).ready(() => {
    $("#mselect").addClass("animate__swing animate__animated");
          });