$(document).ready(function () {
    if(reject == 0){
        $('.appDivFirst,.appDivLast').hide();
    }
   
    $('#applicantType').change(function (e) { 
        e.preventDefault();
        var select=parseInt($(this).val());
        // console.log(typeof(select));
        if(select == 3){
            $('.appDivFirst,.appDivLast,.AppLetter,.letter,.labourCard').show();
            $('.techAppLetter,.extract,.techPassport,.evidence').hide();
            $(".techAppLetter,.extract,.techPassport,.evidence,.passport").find("input").val("");
        }else if (select ==1 ){
            $('.appDivFirst,.appDivLast,.labourCard,.extract').show();
            $('.techPassport,.evidence,.letter').hide();
            $(".letter,.passport").find("input").val("");
        }else if(select == 4){
            $('.appDivFirst,.appDivLast,.techAppLetter,.techPassport,.evidence,.letter').show();
       
            $('.AppLetter,.labourCard,.extract').hide();
            $(".AppLetter,.labourCard,.extract,.passport").find("input").val("");
        }else{
            $('.appDivFirst,.appDivLast').hide();
            $(".appDivFirst,.appDivLast,.passport").find("input").val("");
        }
    });
   
});