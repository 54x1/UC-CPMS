$(document).ready(function () {
  // had a requesting issue fix was add a verison
  if ($('.table').length > 0){
  }else{
  $('.btn-disabled').attr('disabled','disabled');
  }
function mycount(){
 var count = 2;
  var timer = setInterval(function(){
   count--;
   $(".timer").text(count);
   if(count <= 0)
       clearInterval(timer);
   },1000);
}
mycount();
function mySearch(){
  $("#search_query").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".search_table tr").filter(function() {
      $(this).toggle($(this).find("td:first").text().toLowerCase().indexOf(value) > -1)
    });

if($('.search_table tr:visible').length != 0) {

}
else{

  var sResult = $("#search_query").val();

 $('.getid').each(function () {
               $('.getid').text(sResult);

           });

}

});
}
mySearch();

function imgFunc(){
   $(".upload-btn").click(function(){
  $('.upload-btn').attr("disabled", 'disabled');
  $("input:file").removeAttr('disabled');
     $(".imgurl").attr("disabled", 'disabled');
             $(".imgurl-btn").removeAttr('disabled');
             $('.imgurl').val('');
});



$(".imgurl-btn").click(function(){
  $('.imgurl-btn').attr("disabled", 'disabled');
  $("input:file").attr("disabled", 'disabled');
     $(".imgurl").removeAttr('disabled');
        $(".upload-btn").removeAttr('disabled');
        $('input:file').val('');
});


var count = 0;
if (count == 0){
$('img').on("error", function () {
    this.src = ("./uploads/not-found.png");
    count += 1;
});
}
}
imgFunc();
 });
