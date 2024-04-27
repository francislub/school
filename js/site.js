//  Function to add loader
function AddLoader(containerID) {
    var content = '';
    content += ' <span id="SpanLoader"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span></span>';
    $('#' + containerID).append(content);
}

// Function to remove loader
function RemoveLoader(containerID = null) {
    if (containerID) {
        $('#' + containerID).find('#SpanLoader').remove();
    }
    else {
        $('#SpanLoader').remove();
    }
}

//  Function to format date
function FormatDate(dateText) {
    if (dateText) {
        var d = new Date(dateText);
        return d.toDateString();
    } else {
        return "Unknown";
    }
}

// Formating Money With Commas
function formatNumber(num, withOutNaira = false) {
    if (parseInt(num)) {
      if (withOutNaira) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
      } else {
        return '₦' + num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
      }

    }
    return num;
}

//  Function for printing
function PrintElem(elem) {
    var mywindow = window.open('', 'PRINT', 'height=800,width=1000');

    mywindow.document.write('<html><head><title>' + document.title + '</title>');
    mywindow.document.write(`<link rel="stylesheet" href="../css/print.css" type="text/css" /><link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />`);
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.querySelector(`#${elem}`).innerHTML);
    mywindow.document.write('</body>');
    mywindow.document.write('</html>');
    mywindow.document.close();
    mywindow.document.addEventListener("contextmenu", function (e) {
        e.preventDefault();
    }, false);
    $(mywindow.document).keydown(function (event) {
        if (event.keyCode === 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode === 73) { // Prevent Ctrl+Shift+I        
            return false;
        }
    });
    mywindow.focus();
    mywindow.print();
    // mywindow.close();
    // mywindow.document.close(); //  necessary for IE >= 10
    // mywindow.focus(); //  necessary for IE >= 10*/

    // mywindow.print();
    // mywindow.close();

    return true;
}

function disableFraud(AskBe4Navigate=true, DisableEdit = true) {
    if (AskBe4Navigate) {
        window.onbeforeunload = function () {
            return "Are you sure you want to navigate away?";
        };
    }

    if (DisableEdit) {
        document.addEventListener("contextmenu", function (e) {
            e.preventDefault();
        }, false);

        $(document).keydown(function (event) {
            if (event.keyCode == 123) { // Prevent F12
                return false;
            } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
                return false;
            }
        });
    }

}

//  Function for notification
function notificationHandler(message = "", type = "", time = 25000) {
    if (type.toLocaleLowerCase() === "success") {
        toastr.success(message, "Success", {
            "showMethod": "slideDown",
            "hideMethod": "slideUp",
            timeOut: time,
            "closeButton": true
        });
    } else if (type.toLowerCase() === "error") {
        toastr.error(message, "Error", {
            "showMethod": "slideDown",
            "hideMethod": "slideUp",
            timeOut: time,
            "closeButton": true
        });
    } else if (type.toLowerCase() === "warning") {
        toastr.warning(message, "Warning", {
            "showMethod": "slideDown",
            "hideMethod": "slideUp",
            timeOut: time,
            "closeButton": true
        });
    } else {
        toastr.info(message, "Information", {
            "showMethod": "slideDown",
            "hideMethod": "slideUp",
            timeOut: time,
            "closeButton": true
        });
    }
}
