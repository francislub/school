// Phone
var input = document.querySelector("#PhoneNumber");
// validMsg = document.querySelector("#valid-msg");

// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["X", "X", "X", "X", "X"];

// initialise plugin
var iti = window.intlTelInput(input, ({
    // options here
    preferredCountries: ["ng"],
    utilsScript: "plugin/TelPlugin/build/js/utils.js?<%= time %>",
    allowDropdown: true,
    autoHideDialCode: true,
    autoPlaceholder: "polite",
    customPlaceholder: null,
    dropdownContainer: null,
    excludeCountries: [],
    formatOnDisplay: true,
    geoIpLookup: null,
    hiddenInput: "",
    initialCountry: "",
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
            document.getElementById('submit').disabled = false;

        } else {
            input.classList.add("error");
            document.getElementById('submit').disabled = true;
        }
    }
});


$(document).ready(function () {
    // Add a new method to add any kind of regex in jquery validate to be called as a property unser the rules
    jQuery.validator.addMethod("regex", function (value, element, exp) {
        return this.optional(element) || exp.test(value);
    }, "Enter the correct rules");

    // buy pin form instance
    const buyForm = $("#BuyPIN");

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

    // jquery validate plugin to validate buy pin form
    buyForm.validate({
        rules: {
            surname: {
                required: true,
                minlength: 2,
                regex: /^[A-Za-z-][A-Za-z-]*$/
            },
            othernames: {
                required: true,
                minlength: 2,
                regex: /^[A-Za-z-][A-Za-z -]*$/
            },
            email: {
                required: true,
                email: true
            },
            Phone: {
                required: true
            },
            paymentOptions: "required",
            agree: {
                required: true
            }
        },
        messages: {
            surname: {
                required: "Enter your Surname",
                minlength: "Your username must consist of at least 2 characters",
                regex: "Your username must consist of at least 2 characters"

            },
            othernames: {
                required: "Enter your othername",
                minlength: "Your username must consist of at least 2 characters",
                regex: "Your username must consist of at least 2 characters"

            },
            email: "Enter a valid email address",
            Phone: {
                required: "Enter your number"
            },
            agree: {
                required: "Click on the agreement switch"
            }
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            form.submit();
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
            $('#myModal2').modal('hide')
        }
    });



    $('#myModal2').on('hide.bs.modal', function (e) {
        // do something...
        let d = document.activeElement;
        if (d.getAttribute('data-dismiss') === 'modal')
            $('#agree').click();
    });


});

