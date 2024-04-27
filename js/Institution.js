/******************************** VERIFY RESULT PAGE ****************************************************/

var $CandArray = [];
function GetNextCandidate(myArray) {
    if (myArray.length > 0) {
        var nextRecord = myArray.filter(x => x.IsProcessed == false);
        $('.processingStatusButton').html('Processing ' + (myArray.length - nextRecord.length) + ' of ' + myArray.length + '&nbsp;&nbsp;&nbsp;<span id="SpanLoader"> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <span class="sr-only">Loading...</span></span>');

        if (nextRecord.length > 0)
            return nextRecord[0];

        return null;
    }
}
function UpdateCandidate(model) {
    $CandArray.find(x => x.CandidateNo == model.CandidateNo && x.ExamYear == model.ExamYear).IsProcessed = true;
}
function ProcessResultNew(buttonId) {
    var model = GetNextCandidate($CandArray);
    $.ajax({
        type: "POST",
        url: '../Institution/VerifyResult',
        data: JSON.stringify(model),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            if (result.state == '1') {
                var content = GetResultContent(result.data, result.msg, model.ExamYear);
                $('#ViewResultDiv').append(content);
            } else {
                $('#ViewResultDiv').append('<p class="norecord" style="padding:5px; margin-top:10px; color:red; width: fit-content; margin: 0 auto; page-break-inside: avoid; border:1px solid #808080; text-align:center; margin-bottom: 10px;">' + result.msg + '</p>');
            }
            $('#myModal2').modal('show');
            $("#ViewResultButton").html('<i class="ft-arrow-left"></i> View Result')
            $('#ViewResultButton').css('display', 'block');

            //Update(model);
            UpdateCandidate(model);

            var nextRecord = GetNextCandidate($CandArray);
            if (nextRecord != null) {
                ProcessResultNew(buttonId);
            }
            else {
                WrapUpProcessingResult(buttonId)
            }
        },
        error: function (result) {
            notificationHandler('Unable to process a result at this time', 'error')

            //Update(model);
            UpdateCandidate(model);

            var nextRecord = GetNextCandidate($CandArray);
            if (nextRecord != null) {
                ProcessResultNew();
            }
            else {
                WrapUpProcessingResult(buttonId)
            }
        }
    });
}
function WrapUpProcessingResult(buttonId) {
    RemoveLoader();
    RemoveLoader();
    $('#' + buttonId).attr('disabled', false);
    $('.processingStatusButton').html('Processing Completed. Click to Print');
    $('.processingStatusButton').removeClass('btn-primary');
    $('.processingStatusButton').addClass('btn-success');
    $('.processingStatusButton').attr('id', 'PrintResult');
    $('.processingStatusButton').attr("onclick", "PrintElem('ViewResultDiv');");
    for (var i = 0; i < $CandArray.length; i++) {
        $CandArray[i].IsProcessed = false;
    }
}


// Submiting Form For Similar Exam
$('#SimilarExamForm').on('submit', function (e) {
    e.preventDefault();
    const examNumbers = $('#similarExamTypeSelectBox').val();
    const ExamType = $('#ExamType').val();
    const ExamYear = $('#ExamYear').val();
    const examNumbersLength = examNumbers.length
    if (examNumbersLength < 1) {
        notificationHandler('No Exam Type Inputed', 'warning')
        return false;
    }

    $CandArray = [];
    $('#CheckSimilarExam').attr('disabled', true);
    AddLoader('CheckSimilarExam');
    $('#ViewResultDiv').html('');
    buttonId = "CheckSimilarExam";
    for (var i = 0; i < examNumbers.length; i++) {
        var CandDetail = { CandidateNo: examNumbers[i], ExamYear: ExamYear, ExamType: ExamType, IsProcessed: false };
        $CandArray.push(CandDetail);
    }
    ProcessResultNew(buttonId);

    //processArray(examNumbers, ExamType, ExamYear, buttonId);
    //for (let i = 0; i < examNumbersLength; i++) {
    //    var model =
    //    {
    //        ExamName: $('#ExamType').children("option:selected").text(),
    //        ExamType: ExamType,
    //        ExamYear: ExamYear,
    //        CandidateNo: examNumbers[i]
    //    };
    //    ProcessResult(model, 'CheckSimilarExam');
    //}
    return false;
});


async function processArray(ExamNumber, ExamType, ExamYear, buttonId) {
    if (Array.isArray(ExamType) && Array.isArray(ExamYear)) {
        // For different Exam Year and Exam Type
        let i = 0;
        for (const item of ExamNumber) {
            var model =
            {
                ExamName: $('.ExamTypes option:selected')[i].text,
                ExamType: ExamType[i],
                ExamYear: ExamYear[i],
                CandidateNo: item
            };
            await delayedLog(model, buttonId);
            i++;
        }
    }
    else if (Array.isArray(ExamYear))
    {
        // For Batch Upload
        let i = 0;
        for (const item of ExamNumber)
        {
            var model =
            {
                ExamName: 'WASSCE (For School Candidates)',
                ExamType: ExamType,
                ExamYear: ExamYear[i],
                CandidateNo: item
            };
            await delayedLog(model, buttonId);
            i++;
        }
    }
    else
    {
         // For Similar Exam Year and Exam type
        for (const item of ExamNumber)
        {
            var model =
            {
                ExamName: $('#ExamType').children("option:selected").text(),
                ExamType: ExamType,
                ExamYear: ExamYear,
                CandidateNo: item
            };
            await delayedLog(model, buttonId);
        }
    }
    RemoveLoader();
    RemoveLoader();

}
async function delayedLog(model, buttonId) {
    // notice that we can await a function
    // that returns a promise
    await delay();
    $.ajax({
        type: "POST",
        url: '../Institution/VerifyResult',
        data: JSON.stringify(model),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            if (result.state == '1') {
                var content = GetResultContent(result.data, result.msg);
                $('#ViewResultDiv').append(content);
            } else {
                $('#ViewResultDiv').append('<p class="norecord" style="padding:5px; margin-top:10px; color:red; width: fit-content; margin: 0 auto; page-break-inside: avoid; border:1px solid #808080; text-align:center; margin-bottom: 10px;">' + result.msg + '</p>');
            }
            $('#myModal2').modal('show');
            $("#ViewResultButton").html('<i class="ft-arrow-left"></i> View Result')
            $('#ViewResultButton').css('display', 'block');
            $('#' + buttonId).attr('disabled', false);
            //RemoveLoader();
            //RemoveLoader();
        },
        error: function (result) {
            notificationHandler('Unable to process a result at this time', 'error')
            $('#' + buttonId).attr('disabled', false);
            //RemoveLoader();
            //RemoveLoader();
        }
    });
}
function delay() {
    return new Promise(resolve => setTimeout(resolve, 400));
}

// Example POST method implementation:
async function postData(url = '', data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
        mode: 'cors', // no-cors, *cors, same-origin
        cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
        credentials: 'same-origin', // include, *same-origin, omit
        headers: {
            'Content-Type': 'application/json'
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        redirect: 'follow', // manual, *follow, error
        referrerPolicy: 'no-referrer', // no-referrer, *client
        body: JSON.stringify(data) // body data type must match "Content-Type" header
    });
    return await response.json(); // parses JSON response into native JavaScript objects
}
const successfunc = (result, buttonId) => {
    if (+result.state === 1) {
        const content = GetResultContent(result.data, result.msg);
        $('#ViewResultDiv').append(content);
    } else {
        $('#ViewResultDiv').append('<p class="norecord" style="padding:5px; margin-top:10px; color:red; width: fit-content; margin: 0 auto; page-break-inside: avoid; border:1px solid #808080; text-align:center; margin-bottom: 10px;">' + result.msg + '</p>');
    }
    $('#myModal2').modal('show');
    $("#ViewResultButton").html('<i class="ft-arrow-left"></i> View Result')
    $('#ViewResultButton').css('display', 'block');
    $('#' + buttonId).attr('disabled', false);
};
function myAjax(model) {
    $.ajax({
        type: "POST",
        url: '../Institution/VerifyResult',
        data: JSON.stringify(model),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            
            //RemoveLoader();
            //RemoveLoader();
        },
        error: function (result) {
            notificationHandler('Unable to process a result at this time', 'error')
            $('#' + buttonId).attr('disabled', false);
            //RemoveLoader();
            //RemoveLoader();
        }
    });
}

// Submiting Form For Different Exam Type
$('#DifferentExamForm').on('submit', function (e) {
    e.preventDefault();
    var ExamTypes = $('.ExamTypes').map(function (idx, elem) {
        return $(elem).val();
    }).get();
    var ExamYears = $('.ExamYears').map(function (idx, elem) {
        return $(elem).val();
    }).get();
    var ExamNumbers = $('.ExamNumbers').map(function (idx, elem) {
        return $(elem).val();
    }).get();
    if (ExamTypes.length < 1 || ExamYears.length < 1 || ExamNumbers.length < 1) {
        notificationHandler('All Fields Are Required', 'warning')
        return false;
    }
    $CandArray = [];
    $('#CheckDifferentExam').attr('disabled', true);
    AddLoader('CheckDifferentExam');
    $('#ViewResultDiv').html('');
    const buttonId = "CheckDifferentExam";
    for (var i = 0; i < ExamNumbers.length; i++) {
        var CandDetail = { CandidateNo: ExamNumbers[i], ExamYear: ExamYears[i], ExamType: ExamTypes[i], IsProcessed: false };
        $CandArray.push(CandDetail);
    }
    ProcessResultNew(buttonId);

    //processArray(ExamNumbers, ExamTypes, ExamYears, buttonId);
    //for (let i = 0; i < ExamTypes.length; i++) {
    //    var model =
    //    {
    //        ExamName: $('.ExamTypes option:selected')[i].text,
    //        ExamType: ExamTypes[i],
    //        ExamYear: ExamYears[i],
    //        CandidateNo: ExamNumbers[i]
    //    };
    //    ProcessResult(model, 'CheckDifferentExam');
    //}
    return false;
});

//Function to process the result
function ProcessResult(model, buttonId) {
    $.ajax({
        type: "POST",
        url: '../Institution/VerifyResult',
        data: JSON.stringify(model),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (result) {
            if (result.state == '1') {
                var content = GetResultContent(result.data, result.msg);
                $('#ViewResultDiv').append(content);
            } else {
                $('#ViewResultDiv').append('<p class="norecord" style="padding:5px; margin-top:10px; color:red; width: fit-content; margin: 0 auto; page-break-inside: avoid; border:1px solid #808080; text-align:center; margin-bottom: 10px;">' + result.msg + '</p>');
            }
            $('#myModal2').modal('show');
            $("#ViewResultButton").html('<i class="ft-arrow-left"></i> View Result')
            $('#ViewResultButton').css('display', 'block');
            $('#' + buttonId).attr('disabled', false);
            RemoveLoader();
            RemoveLoader();
        },
        error: function (result) {
            notificationHandler('Unable to process a result at this time', 'error')
            $('#' + buttonId).attr('disabled', false);
            RemoveLoader();
            RemoveLoader();
        }
    });

}

// FUnction to create content result form printing
function GetResultContent(data, msg, ExamYear) {
    try {
        var objToday = new Date(),
            weekday = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'),
            dayOfWeek = weekday[objToday.getDay()],
            domEnder = function () { var a = objToday; if (/1/.test(parseInt((a + "").charAt(0)))) return "th"; a = parseInt((a + "").charAt(1)); return 1 == a ? "st" : 2 == a ? "nd" : 3 == a ? "rd" : "th" }(),
            dayOfMonth = today + (objToday.getDate() < 10) ? '0' + objToday.getDate() + domEnder : objToday.getDate() + domEnder,
            months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
            curMonth = months[objToday.getMonth()],
            curYear = objToday.getFullYear(),
            curHour = objToday.getHours() > 12 ? objToday.getHours() - 12 : (objToday.getHours() < 10 ? "0" + objToday.getHours() : objToday.getHours()),
            curMinute = objToday.getMinutes() < 10 ? "0" + objToday.getMinutes() : objToday.getMinutes(),
            curSeconds = objToday.getSeconds() < 10 ? "0" + objToday.getSeconds() : objToday.getSeconds(),
            curMeridiem = objToday.getHours() > 12 ? "PM" : "AM";
        var today = curHour + ":" + curMinute + "." + curSeconds + curMeridiem + " " + dayOfWeek + " " + dayOfMonth + " of " + curMonth + ", " + curYear;

        const sex = data.candidateProfile[0].sex == 1 ? 'Male' : 'Female';
        var diet = 'WASSCE (' + data.candidateProfile[0].diet + ')'; 
        const examType =diet != '' ? diet : (data.candidateProfile[0].examCode == 1 ? 'WASSCE (For School Candidates)' : 'WASSCE (For Private Candidates)');
        let examYear = ExamYear;
        let passport = '../app-assets/img/no_user.png';
        let logo = '../image/WAEC.png';

        if(data.candidateInfo != null){
            examYear = data.candidateInfo[0].examYear ? data.candidateInfo[0].examYear : '****';
            //passport = '../General/ShowPicture?CandidateNo=' + data.candidateProfile[0].candNo + '&ExamYear=' + examYear + '&ExamType=' + data.candidateProfile[0].examCode;
            //passport = data.candidateInfo[0].passport ? 'data:image/jpeg;base64,' + data.candidateInfo[0].passport : '../~/app-assets/img/no_user.png';
        }
        passport = '../General/ShowPicture?CandidateNo=' + data.candidateProfile[0].candNo + '&ExamYear=' + examYear + '&ExamType=' + data.candidateProfile[0].examCode;

        var content = '';
        content += '<div style="padding:2px; margin-top:10px; width: fit-content; margin: 0 auto; page-break-inside: avoid; border-bottom: 3px ridge; padding-bottom: 20px;" class="content">'
        content += '<p align="right">' + examType + ', ' + examYear + ' -- <b>' + data.candidateProfile[0].candNo + '</b></p>'
        content += '<p align="right" style="color:blue; margin-top:-17px;">' + msg + '</p>'
        content += '<table style="width:460px; border:1px solid #808080; border-collapse:collapse" >'
        content += '<tr>'
        content += '<th colspan="6" style="border:1px solid #808080; text-align:center; color: #808080;">Personal Information</th>'
        content += '</tr>'
        content += '<tr style="border:1px solid #808080 ;">'
        content += '<td rowspan="4" colspan="3" style="border:1px solid #808080 ; width:35%"><img src="' + passport + '" alt="Passport" style="height:130px; width:100%; display:flex; margin:auto" /></td>'
        content += '<td style="border:1px solid #808080; padding-left: 10px;">Name:</td>'
        content += '<td style="border:1px solid #808080;padding-left: 10px;" colspan="2"><b>' + data.candidateProfile[0].surname + ' ' + data.candidateProfile[0].firstName + ' ' + data.candidateProfile[0].otherNames + '</b></td>'
        content += '</tr>'
        content += '<tr style="border:1px solid #808080;">'
        content += '<td style="border:1px solid #808080; padding-left: 10px;" >Date of Birth:</td>'
        content += '<td style="border:1px solid #808080; padding-left: 10px;" colspan="3"><b>' + FormatDate(data.candidateProfile[0].dob) + '</b></td>'
        content += '</tr>'
        content += '<tr style="border:1px solid #808080 ;">'
        content += '<td style="border:1px solid #808080; padding-left: 10px;">Sex:</td>'
        content += '<td style="border:1px solid #808080; padding-left: 10px;" colspan="3"><b>' + sex + '</b></td>'
        content += '</tr>'
        content += '<tr>'
        content += '<td style="border:1px solid #808080; padding-left: 10px;">Centre:</td>'
        content += '<td style="border:1px solid #808080; padding-left: 10px;" colspan="3"><b>' + data.candidateCenter[0].centreName + '</b></td>'
        content += '</tr>'
        content += '<tr style="border:1px solid #808080 ;">'
        content += '<th colspan="6" style="border:1px solid #808080; text-align:center; color: #808080;">Candidate Result</th>'
        content += '</tr>';
        for (var prop in data.candidateResult) {
            content += '<tr style="border:1px solid #808080 ;">'
            content += '<td colspan="4" style="border:1px solid #808080; padding-left: 30px">' + data.candidateResult[prop].subject + '</td>'
            content += '<td style="border:1px solid #808080; padding-left: 15px" colspan="3"><b>' + data.candidateResult[prop].grade + '</b></td>'
            content += '</tr>'
        }
        content += '</table>'
        content += '<p align="center"><b>**Result valid as at ' + today +'<b></p>'
        content += '</div>'
        return content;

    } catch (e) {
        var content = '';
        content += '<p style="border:1px solid red; color:red; padding:8px; margin-top:5px; text-align:center;">An Error Ocured</p>';
        return content;

    }
}

// counting the number of entries for exam number
$('#similarExamTypeSelectBox').on('change', function () {
    var count = $(this).val().length;
    $('#examCount').html(count);
    if (count >= 50) {
        MaximumExamReached();
    }
});

// switchinig the div for similar and different exam type and year
$('#differentExamType').hide();
$('#switchery').on('change',
    function () {
        $("#ViewResultButton").html('<i class="ft-arrow-left"></i> View Previous Result')
        $('#similarExamType, #differentExamType').toggle(200);
    }
);

// Logic for adding and deleting exam for different exam year and type
$('#addExam').on('click', function () {
    var rowCount = $('#examTypeTable tr').length - 1;
    if (rowCount < 50) {
        content = CreateExamContent(rowCount);
        $('#examTypeTable').append(content);
        SortTableSN();
    } else {
        MaximumExamReached();
    }
});

// Find and remove selected table rows
$("#examTypeTable").on("click", "#DeleteButton", function () {
    $(this).closest("tr").remove();
    SortTableSN();
});


//function for alerting maximum number of exam that can be added as reach
function MaximumExamReached() {
    notificationHandler('Maximum Number Reached', 'warning')
}

//function to rearrange the table serial number
function SortTableSN() {
    var row = 0;
    $('#examTypeTable tr').each(function () {
        $(this).find('td:first-child').html(row);
        row++;
    });
}

/////////////////////////////////// END VERIFY RESULT PAGE ///////////////////////////////////////////////








//////////////////////////////////// VIEW ACTIVITIES PAGE //////////////////////////////////////////////////
// switchinig the div for Search type
hideAllDivs();
$('#searchBy').on('change',
    function () {
        if ($(this).val() == "Date") {
            hideAllDivs();
            $('#DateDiv').show(200);
        }
        if ($(this).val() == "User") {
            hideAllDivs();
            $('#UserDiv').show(200);
        }
        if ($(this).val() == "Action") {
            hideAllDivs();
            $('#ActionDiv').show(200);
        }
        if ($(this).val() == "Duration") {
            hideAllDivs();
            $('#DurationDiv').show(200);
        }

    }
);

//function to hide all the div
function hideAllDivs() {
    $('#DateDiv').hide(200);
    $('#UserDiv').hide(200);
    $('#ActionDiv').hide(200);
    $('#DurationDiv').hide(200);
}

/////////////////////////////////// VIEW ACTIVITIES PAGE ///////////////////////////////////////////////








//////////////////////////////////// EXTEND SUBSCRIPTION PAGE //////////////////////////////////////////////////
// switchinig the div for payment type
$('#PaymentCardDiv').hide();
$('#BankCarddDiv').hide();
var subAmt = $('#subAmount').text();
//change value to USD if UP is used
if ($('#PaymentType').val() == '2') subAmt = $('#subAmountU').text();

$('#PaymentType').on('change',
    function () { 
        subAmt = $('#subAmount').text();
        if ($(this).val() == '1' || $(this).val() == '2' || $(this).val() == '4') {
            $('#BankCarddDiv').hide(100);
            $('#PaymentCardDiv').show(200);
            $('#SubscriptionUnit').val('');
            $('#ReferencePin').removeAttr('required');
        }
        else if ($(this).val() == '3') {
            $('#ReferencePin').attr('required', 'required');
            $('#BankCarddDiv').show(100);
            $('#SubscriptionUnit').val(1);
            $('#PaymentCardDiv').hide(200);
        } else {
            $('#PaymentCardDiv').hide();
            $('#BankCarddDiv').hide();
        }
        if ($('#PaymentType').val() == '2') subAmt = $('#subAmountU').text();
    });

$('#SubscriptionUnit').on('change', function () {
    try {
        var subUnit = $('#SubscriptionUnit').val();
        var totalAmt = parseFloat(subAmt) * parseInt(subUnit);
        if (subUnit != "") {
            $('#totalAmount').text('Total Amount: ' + formatNumber(totalAmt, true));
        }
       
    } catch (ex) {
        $('#totalAmount').text(0.00);
    }
});


/////////////////////////////////// END EXTEND SUBSCRIPTION PAGE ///////////////////////////////////////////////

//////////////////////////////////// INSTITUTION REGISTRATION PAGE //////////////////////////////////////////////////
// switchinig the div for payment type
$(document).ready(
    function () {
        if ($('#PaymentOptions').val() == '3') {
            $('#UnitsNo').val('1');
            $('#UnitsNo').attr('max', '1');
            $('#totalAmount').text('');
        } else {
            $('#UnitsNo').val('');
            $('#UnitsNo').removeAttr('max');
            $('#totalAmount').text('');
        }
    });

var indSubAmt = $('#subscriptionRateId').text();
if ($('#PaymentOptions').val() == '2') indSubAmt = $('#subscriptionRateIdU').text(); // dollar rate
$('#PaymentOptions').on('change',
    function () {
        indSubAmt = $('#subscriptionRateId').text();
        if ($(this).val() == '3') {
            $('#UnitsNo').val(1);
            $('#UnitsNo').attr('max', '1');         
            $('#UnitsNo').attr('readonly', 'readonly');  
            $('#totalAmount').text('Total Amount: ' + formatNumber(indSubAmt));
        } else {
            $('#UnitsNo').val('');
            $('#UnitsNo').removeAttr('max');
            $('#UnitsNo').removeAttr('readonly');
            $('#totalAmount').text('');
        }
        if ($('#PaymentOptions').val() == '2') indSubAmt = $('#subscriptionRateIdU').text(); // dollar rate
    });


$('#UnitsNo').on('change', function () {    
    try {
        var subUnit = $('#UnitsNo').val();
        var totalAmt = parseFloat(indSubAmt) * parseInt(subUnit);
        if (subUnit != "") {
            $('#totalAmount').text('Total Amount: ' + formatNumber(totalAmt));
        }
    } catch (ex) {
        console.log(ex);
        $('#totalAmount').text(0.00);
    }
});

/////////////////////////////////// END INSTITUTION REGISTRATION PAGE ///////////////////////////////////////////////


//////////////////////////////////// SUBSCRIPTION STATUS PAGE //////////////////////////////////////////////////

/////////////////////////////////// END SUBSCRIPTION STATUS PAGE ///////////////////////////////////////////////



/////////////////////////////////// RENEW CONFIRMATION PAGE ///////////////////////////////////////////////



/////////////////////////////////// END RENEW CONFIRMATION PAGE ///////////////////////////////////////////////
