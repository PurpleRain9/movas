

$('.mybutton').on('click',function(){
// var user_info = JSON.parse({{$user_arr}});
// console.log(user_info);

var isDisable = false;

for (var i = 1; i <= 7; i++) {
    
    // if($('#applicantType'+i+'').val() == "3" && $('#stay_type_id'+i+'').val() == ''){
    //     $('#alertmsg'+i+'').removeClass('d-none');
    //     $('#stay_type_id'+i+'').addClass('border-danger');
    //     $('#labouralert'+i+'').removeClass('d-none');
    //     $('#labour_card_type_id'+i+'').addClass('border-danger');
    //     isDisable = true;
    // }
    if($('#applicantType'+i+'').val() == "3" && $('#stay_type_id'+i+'').val() != '' && $('#labour_card_type_id'+i+'').val() == ''){
        $('#alertmsg'+i+'').removeClass('d-none');
        $('#labouralert'+i+'').removeClass('d-none');
        $('#labour_card_type_id'+i+'').addClass('border-danger');
        isDisable = true;
    }
    else if($('#applicantType'+i+'').val() == "3" && $('#stay_type_id'+i+'').val() == ''){
        $('#labouralert'+i+'').addClass('d-none');
        $('#labour_card_type_id'+i+'').removeClass('border-danger');
        isDisable = false;
    }
    else if($('#file'+i+'').val() != '' && $('#des'+i+'').val() == ''){
        $('#stay_type_id'+i+'').removeClass('border-danger');
        $('#labouralert'+i+'').removeClass('d-none');
        $('#labour_card_type_id'+i+'').removeClass('border-danger');
        $('#desmsg'+i+'').removeClass('d-none');
        $('#des'+i+'').addClass('border-danger');
        isDisable = true;
    }
    
}

// နေထိုင်ခွင့်ကို ၂ လ ကြိုလျှောက်
// (No more than two months ahead) for stay expire date
// var isStayOk = 1;
// for (var i = 1; i <= 7; i++) {
//     var expireDate = $('#StayExpireDate1'+i+'').val();
//     const d = new Date();
//     var newDate = new Date(d.setMonth(d.getMonth()+2)).toISOString().split('T')[0];

//     if($('#stay_type_id'+i+'').val() != ''){
//         if (newDate < expireDate) {
//             isStayOk = 0;
//         }
//     }
    
// }


if(isDisable == true){       
    $('#btnsave').removeAttr('style');
    $('#btnsave').addClass('btn-secondary');
    $('#btnsave').addClass('disabled');
    $('#inputMsg').removeClass('d-none');
}else{
    $('#btnsave').removeClass('disabled');
    $('#inputMsg').addClass('d-none');
}

var titlehtml = '';
var bodyhtml = '';

var companyName = $('#comName').val();

var ApplicantNumbers = 0;
var VisaApply = false;
var StayApply = false;
var LabourCardApply = false;
var Subject = "";

var VisaApplySingle = false;
var VisaApplyMultiple = false;
var LabourCardApplyNew = false;
var LabourCardApplyRenew = false;

var oss_status = '';
var app_numbers = '၀';
var des = '';

if ($('#nationality_id1').val() != '' && $('#PersonName1').val() != '' && $('.PassportNo1').val() != '') {
    
    if ($('#visa_type_id1').val() != '' && $('#visa_type_id1').val() != null) {
        VisaApply = true;

        if ($('#visa_type_id1').val() == 1){
            VisaApplySingle = true;
        } else if ($('#visa_type_id1').val() == 2){
            VisaApplyMultiple = true;
        }
    }
    if ($('#stay_type_id1').val() != '' && $('#stay_type_id1').val() != null) {
        StayApply = true;
    }
    if ($('#labour_card_type_id1').val() != '' && $('#labour_card_type_id1').val() != null) {
        LabourCardApply = true;

        if ($('#labour_card_type_id1').val() == 1){
            LabourCardApplyNew = true;
        } else if ($('#labour_card_type_id1').val() == 2){
            LabourCardApplyRenew = true;
        }
    }      

    ApplicantNumbers += 1;
    
}

//1-immigration, 2-labour, 3-both
if (StayApply == true && VisaApply == true && LabourCardApply == true) {
    if (VisaApplySingle == true && VisaApplyMultiple == true) {
        Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    } else if (VisaApplySingle == true && VisaApplyMultiple == false) {
        Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    } else if (VisaApplySingle == false && VisaApplyMultiple == true) {
        Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    }

    Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့်၊ " + Subject + " နှင့် ";

    if (LabourCardApplyNew == true && LabourCardApplyRenew == true) {
        Subject += "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
    } else if (LabourCardApplyNew == true && LabourCardApplyRenew == false) {
        Subject += "အလုပ်သမားကဒ် အသစ်";
    } else if (LabourCardApplyNew == false && LabourCardApplyRenew == true) {
        Subject += "အလုပ်သမားကဒ် သက်တမ်းတိုး";
    }

    oss_status = 3;
}
else if (StayApply == true && VisaApply == true && LabourCardApply == false) {
    if (VisaApplySingle == true && VisaApplyMultiple == true) {
        Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    } else if (VisaApplySingle == true && VisaApplyMultiple == false) {
        Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    } else if (VisaApplySingle == false && VisaApplyMultiple == true) {
        Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    }
    Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " + Subject;

    oss_status = 1;
}
else if (StayApply == true && VisaApply == false && LabourCardApply == true) {
    if (LabourCardApplyNew == true && LabourCardApplyRenew == true) {
        Subject += "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
    } else if (LabourCardApplyNew == true && LabourCardApplyRenew == false) {
        Subject += "အလုပ်သမားကဒ် အသစ်";
    } else if (LabourCardApplyNew == false && LabourCardApplyRenew == true) {
        Subject += "အလုပ်သမားကဒ် သက်တမ်းတိုး";
    }
    Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " + Subject;

    oss_status = 3;
}
else if (StayApply == false && VisaApply == true && LabourCardApply == true) {
    if (VisaApplySingle == true && VisaApplyMultiple == true) {
        Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    } else if (VisaApplySingle == true && VisaApplyMultiple == false) {
        Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    } else if (VisaApplySingle == false && VisaApplyMultiple == true) {
        Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    }
    Subject = Subject + " နှင့် ";
    if (LabourCardApplyNew == true && LabourCardApplyRenew == true) {
        Subject += "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
    } else if (LabourCardApplyNew == true && LabourCardApplyRenew == false) {
        Subject += "အလုပ်သမားကဒ် အသစ်";
    } else if (LabourCardApplyNew == false && LabourCardApplyRenew == true) {
        Subject += "အလုပ်သမားကဒ် သက်တမ်းတိုး";
    }

    oss_status = 3;
}
else if (StayApply == true && VisaApply == false && LabourCardApply == false) {
    Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခြင်း";
    oss_status = 1;
}
else if (StayApply == false && VisaApply == true && LabourCardApply == false) {
    if (VisaApplySingle == true && VisaApplyMultiple == true) {
        Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    } else if (VisaApplySingle == true && VisaApplyMultiple == false) {
        Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    } else if (VisaApplySingle == false && VisaApplyMultiple == true) {
        Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
    }

    oss_status = 1;
}
else if (StayApply == false && VisaApply == false && LabourCardApply == true) {
    if (LabourCardApplyNew == true && LabourCardApplyRenew == true) {
        Subject += "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
    } else if (LabourCardApplyNew == true && LabourCardApplyRenew == false) {
        Subject += "အလုပ်သမားကဒ် အသစ်";
    } else if (LabourCardApplyNew == false && LabourCardApplyRenew == true) {
        Subject += "အလုပ်သမားကဒ် သက်တမ်းတိုး";
    }

    oss_status = 2;
}


if (ApplicantNumbers == 1) {
    app_numbers = '၁';
}else if (ApplicantNumbers == 2) {
    app_numbers = '၂';
}
else if (ApplicantNumbers == 3) {
    app_numbers = '၃';
}
else if (ApplicantNumbers == 4) {
    app_numbers = '၄';
}
else if (ApplicantNumbers == 5) {
    app_numbers = '၅';
}
else if (ApplicantNumbers == 6) {
    app_numbers = '၆';
}
else if (ApplicantNumbers == 7) {
    app_numbers = '၇';
}

des = "နိုင်ငံခြားသား ( "+app_numbers+" ) ဦး အား "+Subject+" ပြုလုပ်ခွင့်ပေးပါရန် တင်ပြလာခြင်း";


titlehtml = `<div class="col-md-10">
                <p><strong>အကြောင်းအရာ ။ ${companyName} မှ ${des}</strong></p>
            </div>
        `;

$('#checkTitle').html(titlehtml);


// table display
var count = 0;

if($('#PersonName1').val() != '' && $('#nationality_id1').val() != '' && $('.PassportNo1').val() != ''){
    count ++;
    var visaType = '';
    if($('#visa_type_id1').val() == 1)
        visaType = 'တစ်ကြိမ်';
    else if($('#visa_type_id1').val() == 2)
        visaType = 'အကြိမ်ကြိမ်';

    var stayType = '';
    
    if($('#stay_type_id1').val() == 1)
    stayType = '၃ လ';
    else if($('#stay_type_id1').val() == 2)
        stayType = '၆ လ';
    else if($('#stay_type_id1').val() == 3)
        stayType = 'တစ်နှစ်';

    var labourType = '';
    if($('#applicantType1').val() == "4"){
        labourType = 'မှီခို';
    }
    else if($('#labour_card_type_id1').val() == 1)
        labourType = 'အသစ်လျှောက်';
    else if($('#labour_card_type_id1').val() == 2)
        labourType = 'သက်တမ်းတိုး';
    
    var labourDuration = '';
    if($('#labour_card_type_id1').val() == ''){
        labourType = '-';
        labourDuration = '-';            
    }

    else if($('#labour_card_duration1').val() == 1)
        labourDuration = '၃ လ';
    else if($('#labour_card_duration1').val() == 2)
        labourDuration = '၆ လ';
    else if($('#labour_card_duration1').val() == 3)
        labourDuration = 'တစ်နှစ်';

    var nationality = $( "#nationality_id1 option:selected" ).text();
    var applicationName = $( "#applicantType1 option:selected" ).text();


    bodyhtml += `
                <tr>
                    <td>${count}</td>
                    <td>${$('#PersonName1').val()}/${applicationName}</td>
                    <td>${nationality}</td>
                    <td>${$('.PassportNo1').val()}</td>
                    <td>${$('.StayAllowDate1').val()}</td>
                    <td>${$('.StayExpireDate1').val()}</td>
                    <td>${visaType}</td>
                    <td>${stayType}</td>
                    <td>${labourType}/${labourDuration}</td>
                </tr>

            `;
}
})
function checkApplicantType(applicationType) {
    if (applicationType == '4') {
        document.getElementById('dependant').style.display = 'block';
        document.getElementById('labour_type').style.display = 'none';
        document.getElementById('labourduration').style.display = 'none';
    } else {
        document.getElementById('dependant').style.display = 'none';
        document.getElementById('labour_type').style.display = 'block';
    }


}
