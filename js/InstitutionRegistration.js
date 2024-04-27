// Phone
var input = document.querySelector("#PhoneNumber"), errorMsg = document.querySelector("#error-msg");
//validMsg = document.querySelector("#valid-msg");
// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
// initialise plugin
var iti = window.intlTelInput(input, ({
    // options here
    preferredCountries: ["ng"],
    utilsScript: "../plugin/TelPlugin/build/js/utils.js?<%= time %>",
    allowDropdown: true,
    autoHideDialCode: true,
    autoPlaceholder: "polite",
    customPlaceholder: null,
    formatOnDisplay: false,
    dropdownContainer: null,
    excludeCountries: [],
    geoIpLookup: null,
    hiddenInput: "",
    initialCountry: "ng",
    localizedCountries: null,
    nationalMode: true,
    onlyCountries: [],
    placeholderNumberType: "MOBILE",
    separateDialCode: false
}));
var reset = function () {
    input.classList.remove("error");
};
input.addEventListener('blur', function () {
    reset();
    if (input.value.trim()) {
        if (iti.isValidNumber()) {
            input.classList.remove("error");
            errorMsg.classList.add("hide");
            document.getElementById('submit').disabled = false;
        } else {
            input.classList.add("error");
            var errorCode = iti.getValidationError();
            errorMsg.innerHTML = errorMap[errorCode];
            errorMsg.classList.remove("hide");
            document.getElementById('submit').disabled = true;
        }
    }
});
// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);

// Remove the initial inline style to help use jquery validate
const agree = document.querySelector('#agree');
const agreebox = document.querySelector('#agreebox');
agree.removeAttribute('style');
agree.setAttribute("style", `
                    visibility:hidden
                `);

agree.addEventListener("change", () => {
    if (agree.checked) {
        agreebox.checked = true;
        $('#myModal2').modal('show');
    }
});


// Instance of second form on the modal
const agreement = $('#agreement_form');
agreement.validate({
    rules: {
        agreebox: {
            required: true
        }
    },
    messages: {
        agreebox: {
            required: "click on 'I agree' button"
        }
    },
    submitHandler: function (form) {
        $('#myModal2').modal('hide');
    }
});

// This event is fired immediately when the hide instance method has been called.
$('#myModal2').on('hide.bs.modal', function (e) {
    // do something...
    let d = document.activeElement;
    if (d.getAttribute('data-dismiss') === 'modal')
        $('#agree').click();
});