
function validateFile() {
    var fileInput = document.getElementById('applicationORreceipt');
    var mssg = document.getElementById("mssg2");
    var file = fileInput.files[0];

    // Check if a file is selected
    if (!file) {
        mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> Please upload a file.';
        return false;
    }
  
    // Validate file size
    var maxSize = 8 * 1024 * 1024; // 8MB in bytes
    if (file.size > maxSize) {
      mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> File size exceeds the limit of 8MB.';
      return false;
    }
  
    // Validate file format
    var allowedFormat = ["pdf", "png", "jpg", "jpeg"];
    var fileName = file.name.toLowerCase();
    var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
    if (!allowedFormat.includes(fileExtension)) {
      mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> File format can be pdf, jpg, png or jpeg only';
      return false;
    }
  
    // Reset the file input element
    //fileInput.value = '';
    return true;
}
  

// to check enrollment number

function validEnroll() {
    var enroll = document.getElementById('enrollmentNo').value;
    var mssg = document.getElementById("mssg1");

    if (enroll == "") {
        mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> Enter enrollment number.';
        return false;
    }
    else {
        return true;
    }
    
}


// validate receipt number

function validReceiptNo() {
    var receiptNo = document.getElementById('Receiptnumber').value;
    var mssg = document.getElementById("mssg30");

    if (receiptNo == "") {
        mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> Enter receipt number.';
        return false;
    }
    else {
        return true;
    }
}


// validate receipt date

function validReceiptDate() {
    var receiptDate = document.getElementById('ReceiptDate').value;
    var mssg = document.getElementById("mssg40");

    if (receiptDate == "") {
        mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> Enter receipt date.';
        return false;
    }
    else {
        return true;
    }
}


function validateBookRelease() {

    // for receipt and application
    var doc = document.getElementById("fineAmt").value;

    var receipt = validateFile();
    var enroll = validEnroll();

    if (doc == 0) {
        // it means it's application
        var receipt = validateFile();
        var enroll = validEnroll();

        if (receipt && enroll) {
            var confirmation = confirm('Do you want to proceed book release?');
            if (confirmation) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }

    }
    else {
        // receipt
        var receipt = validateFile();
        var enroll = validEnroll();
        var receiptNo = validReceiptNo();
        var receiptDate = validReceiptDate();

        if (receipt && enroll && receiptNo && receiptDate) {
            var confirmation = confirm('Do you want to proceed book release?');
            if (confirmation) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
}