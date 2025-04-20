
// to validate book name

function validBookName() {
    var book_name = document.getElementById("BookName").value;
    var mssg = document.getElementById("mssg1");

    if (book_name == "") {
        mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> Enter book name';
        return false;
    }
    else {
        var regex = /^[A-Za-z0-9\s\-.'(),!@#$%^&*_+=\\|{}[\]:;<>/?"`~]{1,200}$/;
        if (!regex.test(book_name)) {
            mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> Enter valid book name';
            return false;
        }
        else {
            return true;
        }
    }
}

function validIsbnNo() {
    var book_isbn = document.getElementById("isbnNumber").value;
    var mssg = document.getElementById("mssg2");

    if (book_isbn == "") {
        mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> Enter book ISBN number';
        return false;
    }
    else {
        var regex = /^\d{10}$|^\d{13}$/;
        if (!regex.test(book_isbn)) {
            mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> Enter valid book ISBN number';
            return false;
        }
        else {
            return true;
        }
        
    }
}


function validCallNo() {
    var call_no = document.getElementById("callNumber").value;
    var mssg = document.getElementById("mssg10");

    if (call_no == "") {
        mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> Enter call number';
        return false;
    }
    else {
        return true;
    }
}



function validBookNo() {
    var book_no = document.getElementById("bookNumber").value;
    var mssg = document.getElementById("mssg20");

    if (book_no == "") {
        mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> Enter book number';
        return false;
    }
    else {
        var regex = /^[0-9]{4,6}$/;
        if (!regex.test(book_no)) {
            mssg.innerHTML = '<i class="mdi mdi-alert-circle-outline"></i> Enter valid book number';
            return false;
        }
        else {
            return true;
        }
        
    }
}



// common function 
function validateBookEntry() {
    var bookName = validBookName();
    var bookisbn = validIsbnNo();

    var call_no = validCallNo();
    var book_no = validBookNo();

    if (bookName && bookisbn && call_no && book_no) {
        return true;
    }
    else {
        return false;
    }
}