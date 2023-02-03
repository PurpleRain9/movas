$(document).ready(function () {
    if(reject == 0){
        $('.appDivFirst1').hide();
        $('.appDivLast1').hide();
        $('.appDivFirst2').hide();
        $('.appDivLast2').hide();
        $('.appDivFirst3').hide();
        $('.appDivLast3').hide();
        $('.appDivFirst4').hide();
        $('.appDivLast4').hide();
        $('.appDivFirst5').hide();
        $('.appDivLast5').hide();
        $('.appDivFirst6').hide();
        $('.appDivLast6').hide();
        $('.appDivFirst7').hide();
        $('.appDivLast7').hide();
    }
   
    $('#applicantType1').change(function (e) { 
        e.preventDefault();
        var select=parseInt($(this).val());
        // console.log(typeof(select));
        if(select == 3){
            $('.appDivFirst1').show();
            $('.appDivLast1').show();
            $('.AppLetter1').show();
            $('.letter1').show();
            $('.labourCard1').show();
            $('.techAppLetter1').hide();
            $(".techAppLetter1").find("input").val("");
            $('.extract1').hide();
            $(".extract1").find("input").val("");
            $('.techPassport1').hide();
            $(".techPassport1").find("input").val("");
            $('.evidence1').hide();
            $(".evidence1").find("input").val("");
            $(".passport1").find("input").val("");
            
        }else if (select == 1){
            $('.appDivFirst1').show();
            $('.appDivLast1').show();
            $('.labourCard1').show();
            $('.techPassport1').hide();
            $('.evidence1').hide();
            $('.letter1').hide();
            $(".letter1").find("input").val("");
            $('.extract1').show();
            $(".passport1").find("input").val("");
        }else if(select == 4){
            $('.appDivFirst1').show();
            $('.appDivLast1').show();
            $('.techAppLetter1').show();
            $('.techPassport1').show();
            $('.evidence1').show();
            $('.AppLetter1').hide();
            $(".AppLetter1").find("input").val("");
            $('.letter1').show();
            $('.labourCard1').hide();
            $(".labourCard1").find("input").val("");
            $('.extract1').hide();
            $(".extract1").find("input").val("");
            $(".passport1").find("input").val("");
        }else{
            $('.appDivFirst1').hide();
            $(".appDivFirst1").find("input").val("");
            $('.appDivLast1').hide();
            $(".appDivLast1").find("input").val("");
            $(".passport1").find("input").val("");
        }
    });
    $('#applicantType2').change(function (e) { 
        e.preventDefault();
        var select=parseInt($(this).val());
        // console.log(typeof(select));
        if(select == 3){
            $('.appDivFirst2').show();
            $('.appDivLast2').show();
            $('.AppLetter2').show();
            $('.letter2').show();
            $('.labourCard2').show();
            $('.techAppLetter2').hide();
            $(".techAppLetter2").find("input").val("");
            $('.extract2').hide();
            $(".extract2").find("input").val("");
            $('.techPassport2').hide();
            $(".techPassport2").find("input").val("");
            $('.evidence2').hide();
            $(".evidence2").find("input").val("");
            $(".passport2").find("input").val("");
            
        }else if (select == 1){
            $('.appDivFirst2').show();
            $('.appDivLast2').show();
            $('.labourCard2').show();
            $('.techPassport2').hide();
            $('.evidence2').hide();
            $('.letter2').hide();
            $(".letter2").find("input").val("");
            $('.extract2').show();
            $(".passport2").find("input").val("");
            
        }else if(select == 4){
            $('.appDivFirst2').show();
            $('.appDivLast2').show();
            $('.techAppLetter2').show();
            $('.techPassport2').show();
            $('.evidence2').show();
            $('.AppLetter2').hide();
            $(".AppLetter2").find("input").val("");
            $('.letter2').show();
            $('.labourCard2').hide();
            $(".labourCard2").find("input").val("");
            $('.extract2').hide();
            $(".extract2").find("input").val("");
            $(".passport2").find("input").val("");
        }else{
            $('.appDivFirst2').hide();
            $(".appDivFirst2").find("input").val("");
            $('.appDivLast2').hide();
            $(".appDivLast2").find("input").val("");
            $(".passport2").find("input").val("");
        }
    });
    $('#applicantType3').change(function (e) { 
        e.preventDefault();
        var select=parseInt($(this).val());
        // console.log(typeof(select));
        if(select == 3){
            $('.appDivFirst3').show();
            $('.appDivLast3').show();
            $('.AppLetter3').show();
            $('.letter3').show();
            $('.labourCard3').show();
            $('.techAppLetter3').hide();
            $(".techAppLetter3").find("input").val("");
            $('.extract3').hide();
            $(".extract3").find("input").val("");
            $('.techPassport3').hide();
            $(".techPassport3").find("input").val("");
            $('.evidence3').hide();
            $(".evidence3").find("input").val("");
            $(".passport3").find("input").val("");
            
        }else if (select == 1){
            $('.appDivFirst3').show();
            $('.appDivLast3').show();
            $('.labourCard3').show();
            $('.techPassport3').hide();
            $('.evidence3').hide();
            $('.letter3').hide();
            $(".letter3").find("input").val("");
            $('.extract3').show();
            $(".passport3").find("input").val("");
        }else if(select == 4){
            $('.appDivFirst3').show();
            $('.appDivLast3').show();
            $('.techAppLetter3').show();
            $('.techPassport3').show();
            $('.evidence3').show();
            $('.AppLetter3').hide();
            $(".AppLetter3").find("input").val("");
            $('.letter3').show();
            $('.labourCard3').hide();
            $(".labourCard3").find("input").val("");
            $('.extract3').hide();
            $(".extract3").find("input").val("");
            $(".passport3").find("input").val("");
        }else{
            $('.appDivFirst3').hide();
            $(".appDivFirst3").find("input").val("");
            $('.appDivLast3').hide();
            $(".appDivLast3").find("input").val("");
            $(".passport3").find("input").val("");
        }
    });
    $('#applicantType4').change(function (e) { 
        e.preventDefault();
        var select=parseInt($(this).val());
        // console.log(typeof(select));
        if(select == 3){
            $('.appDivFirst4').show();
            $('.appDivLast4').show();
            $('.AppLetter4').show();
            $('.letter4').show();
            $('.labourCard4').show();
            $('.techAppLetter4').hide();
            $(".techAppLetter4").find("input").val("");
            $('.extract4').hide();
            $(".extract4").find("input").val("");
            $('.techPassport4').hide();
            $(".techPassport4").find("input").val("");
            $('.evidence4').hide();
            $(".evidence4").find("input").val("");
            $(".passport4").find("input").val("");
            
        }else if (select == 1){
            $('.appDivFirst4').show();
            $('.appDivLast4').show();
            $('.labourCard4').show();
            $('.techPassport4').hide();
            $('.evidence4').hide();
            $('.letter4').hide();
            $(".letter4").find("input").val("");
            $('.extract4').show();
            $(".passport4").find("input").val("");
        }else if(select == 4){
            $('.appDivFirst4').show();
            $('.appDivLast4').show();
            $('.techAppLetter4').show();
            $('.techPassport4').show();
            $('.evidence4').show();
            $('.AppLetter4').hide();
            $(".AppLetter4").find("input").val("");
            $('.letter4').show();
            $('.labourCard4').hide();
            $(".labourCard4").find("input").val("");
            $('.extract4').hide();
            $(".extract4").find("input").val("");
            $(".passport4").find("input").val("");
        }else{
            $('.appDivFirst4').hide();
            $(".appDivFirst4").find("input").val("");
            $('.appDivLast4').hide();
            $(".appDivLast4").find("input").val("");
            $(".passport4").find("input").val("");
        }
    });
    $('#applicantType5').change(function (e) { 
        e.preventDefault();
        var select=parseInt($(this).val());
        // console.log(typeof(select));
        if(select == 3){
            $('.appDivFirst5').show();
            $('.appDivLast5').show();
            $('.AppLetter5').show();
            $('.letter5').show();
            $('.labourCard5').show();
            $('.techAppLetter5').hide();
            $(".techAppLetter5").find("input").val("");
            $('.extract5').hide();
            $(".extract5").find("input").val("");
            $('.techPassport5').hide();
            $(".techPassport5").find("input").val("");
            $('.evidence5').hide();
            $(".evidence5").find("input").val("");
            $(".passport5").find("input").val("");
            
        }else if (select == 1){
            $('.appDivFirst5').show();
            $('.appDivLast5').show();
            $('.labourCard5').show();
            $('.techPassport5').hide();
            $('.evidence5').hide();
            $('.letter5').hide();
            $(".letter5").find("input").val("");
            $('.extract5').show();
            $(".passport5").find("input").val("");
        }else if(select == 4){
            $('.appDivFirst5').show();
            $('.appDivLast5').show();
            $('.techAppLetter5').show();
            $('.techPassport5').show();
            $('.evidence5').show();
            $('.AppLetter5').hide();
            $(".AppLetter5").find("input").val("");
            $('.letter5').show();
            $('.labourCard5').hide();
            $(".labourCard5").find("input").val("");
            $('.extract5').hide();
            $(".extract5").find("input").val("");
            $(".passport5").find("input").val("");
        }else{
            $('.appDivFirst5').hide();
            $(".appDivFirst5").find("input").val("");
            $('.appDivLast5').hide();
            $(".appDivLast5").find("input").val("");
            $(".passport5").find("input").val("");
        }
    });
    $('#applicantType6').change(function (e) { 
        e.preventDefault();
        var select=parseInt($(this).val());
        // console.log(typeof(select));
        if(select == 3){
            $('.appDivFirst6').show();
            $('.appDivLast6').show();
            $('.AppLetter6').show();
            $('.letter6').show();
            $('.labourCard6').show();
            $('.techAppLetter6').hide();
            $(".techAppLetter6").find("input").val("");
            $('.extract6').hide();
            $(".extract6").find("input").val("");
            $('.techPassport6').hide();
            $(".techPassport6").find("input").val("");
            $('.evidence6').hide();
            $(".evidence6").find("input").val("");
            $(".passport6").find("input").val("");
            
        }else if (select == 1){
            $('.appDivFirst6').show();
            $('.appDivLast6').show();
            $('.labourCard6').show();
            $('.techPassport6').hide();
            $('.evidence6').hide();
            $('.letter6').hide();
            $(".letter6").find("input").val("");
            $('.extract6').show();
            $(".passport6").find("input").val("");
        }else if(select == 4){
            $('.appDivFirst6').show();
            $('.appDivLast6').show();
            $('.techAppLetter6').show();
            $('.techPassport6').show();
            $('.evidence6').show();
            $('.AppLetter6').hide();
            $(".AppLetter6").find("input").val("");
            $('.letter6').show();
            $('.labourCard6').hide();
            $(".labourCard6").find("input").val("");
            $('.extract6').hide();
            $(".extract6").find("input").val("");
            $(".passport6").find("input").val("");
        }else{
            $('.appDivFirst4').hide();
            $(".appDivFirst4").find("input").val("");
            $('.appDivLast4').hide();
            $(".appDivLast4").find("input").val("");
            $(".passport4").find("input").val("");
        }
    });
    $('#applicantType7').change(function (e) { 
        e.preventDefault();
        var select=parseInt($(this).val());
        // console.log(typeof(select));
        if(select == 3){
            $('.appDivFirst7').show();
            $('.appDivLast7').show();
            $('.AppLetter7').show();
            $('.letter7').show();
            $('.labourCard7').show();
            $('.techAppLetter7').hide();
            $(".techAppLetter7").find("input").val("");
            $('.extract7').hide();
            $(".extract7").find("input").val("");
            $('.techPassport7').hide();
            $(".techPassport7").find("input").val("");
            $('.evidence7').hide();
            $(".evidence7").find("input").val("");
            $(".passport7").find("input").val("");
            
        }else if (select == 1){
            $('.appDivFirst7').show();
            $('.appDivLast7').show();
            $('.labourCard7').show();
            $('.techPassport7').hide();
            $('.evidence7').hide();
            $('.letter7').hide();
            $(".letter7").find("input").val("");
            $('.extract7').show();
            $(".passport7").find("input").val("");
        }else if(select == 4){
            $('.appDivFirst7').show();
            $('.appDivLast7').show();
            $('.techAppLetter7').show();
            $('.techPassport7').show();
            $('.evidence7').show();
            $('.AppLetter7').hide();
            $(".AppLetter7").find("input").val("");
            $('.letter7').show();
            $('.labourCard7').hide();
            $(".labourCard7").find("input").val("");
            $('.extract7').hide();
            $(".extract7").find("input").val("");
            $(".passport7").find("input").val("");
        }else{
            $('.appDivFirst7').hide();
            $(".appDivFirst7").find("input").val("");
            $('.appDivLast7').hide();
            $(".appDivLast7").find("input").val("");
            $(".passport7").find("input").val("");
        }
    });
});