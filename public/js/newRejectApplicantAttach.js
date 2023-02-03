$(document).ready(function () {
   
    if($('#applicantType').val() == "1"){
        document.getElementById('attachmentLabel').innerHTML="Passport, Company Registration Card, Extract Form";
        $('.appDivLast').show();
        $('.labourCard').show();
        $('.techPassport').hide();
        $('.evidence').hide();
        $('.letter').hide();
        $('.extract').show();
    }else if($('#applicantType').val() == "3"){
        document.getElementById('attachmentLabel').innerHTML="Passport, MIC Approved Letter, Labour Card (if any)";
        $('.AppLetter').show();
        $('.letter').show();
        $('.labourCard').show();
        $('.techAppLetter').hide();
        $('.extract').hide();
        $('.techPassport').hide();
        $('.evidence').hide();
    }else if($('#applicantType').val() == "4"){
        document.getElementById('attachmentLabel').innerHTML="Passport, Evidence (eg. Marriage Contract, Birth Certificate), MIC Approved Letter and Technician/Skill Labour's Passport (if Relation with Technician/Skill Labour)";
        $('.techAppLetter').show();
        $('.techPassport').show();
        $('.evidence').show();
        $('.AppLetter').hide();
        $('.letter').show();
        $('.labourCard').hide();
        $('.extract').hide();
        $('#dependant').show();
        $('#labourduration').hide();
        $('#labour_type').hide();
    }
    if($('#labour_card_type_id').val() == ""){
        $('#labourduration').hide();
    }else{
        $('#labourduration').show();
    }
    
});