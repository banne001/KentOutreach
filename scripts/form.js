/**
 * Checks and shows intake form when the toggle is checked
 * Gets the text of the slides and bio descriptions from the server
 * and prints it out.
 */
 $(document).ready(function(){
    $.post("getFormState.php", {}, function(result){
        console.log(result);
        //let res = result;
        if(result == "true"){
            showForm();
        } else {
            hideForm();
        }
    });
});
// Function for showing or hiding the form depending on it it's within business hours

// Listens to the zip code input
document.getElementById("zipCode").addEventListener("input", toggleZipChk);

// Function for toggling the zip code check box if a zip code is inputted, and vice versa
function toggleZipChk() {
    if (!(document.getElementById("zipCode").value == "")) {
        document.getElementById("zipCodeChk").disabled = true;
    } else if (document.getElementById("zipCode").value == "") {
        document.getElementById("zipCodeChk").disabled = false;
    }

    if (document.getElementById("zipCodeChk").checked == true) {
        document.getElementById("zipCode").disabled = true;
    } else if (document.getElementById("zipCodeChk").checked == false) {
        document.getElementById("zipCode").disabled = false;
    }

}

// Function for disabling/enabling the form if the user has input a zip code option
function waitForZip() {

    if (document.getElementById("zipCode").value == 98030 |
        document.getElementById("zipCode").value == 98031 |
        document.getElementById("zipCode").value == 98032 |
        document.getElementById("zipCode").value == 98042 |
        document.getElementById("zipCode").value == 98058 |
        document.getElementById("zipCodeChk").checked == true) {
            document.getElementById("notZipCode").style.pointerEvents = "auto";
            document.getElementById("notZipCode").style.opacity = "1";
            document.getElementById("continue").hidden = true;
            document.getElementById("err-zipCode").hidden = true;

            document.getElementById("zipCode").style.pointerEvents = "none";
            document.getElementById("zipCode").style.opacity = "0.4";

            document.getElementById("zipCodeChk").style.pointerEvents = "none";
            document.getElementById("zipCodeChk").style.opacity = "0.4";

            if (document.getElementById("zipCodeChk").checked == false) {
                document.getElementById("zipCodeChk").hidden = true;
                document.getElementById("zipCodeChkInfo").hidden = true;
            }
    } else {
        document.getElementById("err-zipCode").hidden = false;
    }




}
/**
 * show the form, hides the error message
 */
function showForm(){
    document.getElementById('interestForm').classList.remove("d-none");
    document.getElementById("errorForm").classList.add("d-none");
}
/**
 * hides the form, shows the error message
 */
function hideForm(){
    document.getElementById('interestForm').classList.add("d-none");
    document.getElementById("errorForm").classList.remove("d-none");
}
let otherCheck = document.getElementById("otherChk");
otherCheck.onchange=function(){showText()};
function showText(){
    let text = document.getElementById("otherInput");
    console.log(otherCheck.checked);
    console.log(text.style.display);
    if(otherCheck.checked === true){
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}

// Function for clearing errors at the front of page load, or for overwriting an error to be cleared in case of two errors
function clearErrors(ids){
    // Default - removes all errors if the constructor is "all"
    if (ids === "all") {

        let errors = document.getElementsByClassName("text-danger");
        for(let i=0; i<errors.length; i++) {
            errors[i].classList.add("d-none");

        }
    // Manual - removes select errors with the class name constructor
    } else {

        let errors = document.getElementsByClassName(ids);
        for(let i=0; i<errors.length; i++) {
            errors[i].classList.add("d-none");
        }

    }

}
/**
 * Main function used for validating the form on every submit click
 * @returns {boolean} true if the form is all valid and false if it is not valid
 */
function ValidateForm() {
    // Clears all errors so function can run from scratch every time
    clearErrors("all");

    // Sets up variables to be used later

    // Default for form to be submitted (false will not submit form)
    let submitForm = true;
    // Creates an array of checkbox types to prevent redundancy when checking if any are checked
    let assistanceTypes = ["utilities", "rent", "gas", "clothing", "id", "food", "other"];
    // Default for only requiring one of the checkboxes to be checked
    let chkCounter = 0;
    // Loop to check all of the checkboxes
    for (let i = 0; i < assistanceTypes.length; i++) {
        // Passes in each checkbox type
        if (!(document.getElementById(assistanceTypes[i] + "Chk").checked)) {
            // Counter
            chkCounter++;
            // Counter will be 7 if no checkboxes are checked, or less if at least one is checked.
            if (chkCounter > 6) {
                // This statement returns an error
                document.getElementById("err-assistance").classList.remove("d-none");
                submitForm = false;
            // At least one checkbox is checked
            } else {
                submitForm = true;
            }

        }

    }

    // Checks to make sure otherInput is filled in only if other is checked
    if (document.getElementById('otherInput').value.length == 0 && document.getElementById('otherChk').checked) {
        // This statement returns an error
        document.getElementById("err-otherInput").classList.remove("d-none");
        submitForm = false;
    }


    // Creates an array of input types to prevent redundancy when checking if any are checked
    let inputTypes = ["fname", "lname", "email", "phone"];
    // Loop to check all of the remaining inputs
    // Checks if First and Last Name inputs are empty or not, shows error message if empty
    for (let i = 0; i < 2; i++) {
        // Passes in each input type
        if(checkInput(inputTypes[i])==false){
            document.getElementById("err-" + inputTypes[i]).classList.remove("d-none");
            submitForm = false;
        }
    }

    // Either email or phone can be filled out
    // Checking Email and Result input
    let checkEmailResult = checkInput(inputTypes[2]);
    let checkPhoneResult = checkInput(inputTypes[3]);
    // if both email and Result is not filled out then show error and don't proceed to submission
    if((checkEmailResult === false) && (checkPhoneResult === false)){
        document.getElementById("err-phoneMail").classList.remove("d-none");
        submitForm = false;
    } else if((checkEmailResult === true) && (checkPhoneResult === true)){
        // if both are filled out make sure both is valid
        let checkP = checkPhone(inputTypes[3]);
        let checkE = checkEmail(inputTypes[2]);
        if ((checkP || checkE) === false){
            submitForm = false;
        }
    } else if ((checkEmailResult ===true) && (checkPhoneResult === false)){
        // if the email is filled out check if valid, if not don't submit form
        if(checkEmail(inputTypes[2])=== false){
            submitForm = false;
        }
    } else if ((checkEmailResult === false) && (checkPhoneResult === true)) {
        // if the phone is filled out check if valid
        if (checkPhone(inputTypes[3]) === false) {
            submitForm = false;
        }
    }

    if (document.getElementById("notZipCode").style.pointerEvents == "") {
        clearErrors("all");
    }
    // Will return true if no errors are found in any of the inputs,
    // or will return false if an input is missing or wrong
    return submitForm;

}

/**
 * Checks if the input is empty
 * @param id the element id that is being checked
 * @returns {boolean} true if the input was filled out and false if it was empty
 */
function checkInput(id){
    if(!(document.getElementById(id).value !== "")) {
        return false;
    }
    return true;
}

/**
 * Checks if the email valid
 * @param id the element id that is being checked
 * @returns {boolean} true if the email is valid and false if it is not
 */
function checkEmail(id){
    // Verifies Email is valid (e.g. example@email.com)
    // Borrowed from https://www.w3resource.com/javascript/form/email-validation.php
    let submitForm = true;
    if (!(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test
    (document.getElementById(id).value))) {
        // Email is invalid
        // This statement returns the second error (invalid)
        console.log(document.getElementById("err-" + id + "2").classList);
        document.getElementById("err-" + id + "2").classList.remove("d-none");
        console.log(document.getElementById("err-" + id + "2").classList);
        submitForm = false;
        // Sometimes both errors will show, this if statement will be reached when the email is invalid,
        // and is used to check if there is some sort of input to manually remove the invalid email error if not
        if (!(document.getElementById(id).value !== "")) {
            // Overrides the error to only show the "Field is required" error
            clearErrors(id + "2");
            submitForm = false;
        }
    }
    return submitForm;
}

/**
 * Checks if the phone is a valid phone number
 * @param id the element id that is being checked
 * @returns {boolean} true if the phone is valid and false if it is not valid
 */
function checkPhone(id){
    // Verifies Phone number is valid (e.g. 123 456 7890) Symbols like "-" or "()" will not be allowed
    // Borrowed from https://www.w3resource.com/javascript/form/phone-no-validation.php
    let submitForm = true;
    if (!(/^\d{10}$/).test(document.getElementById(id).value)) {
        // Phone number is invalid
        // This statement returns the second error (invalid)
        console.log(document.getElementById("err-" + id + "2").classList);
        document.getElementById("err-" + id + "2").classList.remove("d-none");
        console.log(document.getElementById("err-" + id + "2").classList);
        submitForm = false;
        // Sometimes both errors will show, this if statement will be reached when the phone number is invalid,
        // and is used to check if there is some sort of input to manually remove the invalid phone number error if not
        if (!(document.getElementById(id).value !== "")) {
            // Overrides the error to only show the "Field is required" error
            clearErrors(id + "2");
            submitForm = false;
        }
    }
    return submitForm;
}


// Function to show and remove the upload button and file uploaded (if applicable) when the checkbox is checked/unchecked
function UploadButton(checkbox) {
    // If statement verifies the right button was checked
    if (document.getElementById(checkbox + "Chk").checked) {
        // Shows the upload button
        document.getElementById(checkbox + "Upl").hidden = false;
        // Adds a extra line to help with formatting
        document.getElementById(checkbox + "BR").hidden = false;
        // Shows the requirements for the upload
        document.getElementById(checkbox + "Notice").hidden = false;
        // Shows the upload preferred message
        document.getElementById("war-" + checkbox + "Upl").hidden = false;

    }
    // If statement verifies the right button was unchecked
    if (!(document.getElementById(checkbox + "Chk").checked)) {
        // Hides the upload button
        document.getElementById(checkbox + "Upl").hidden = "hidden";
        // Hides the extra line to help with formatting
        document.getElementById(checkbox + "BR").hidden = "hidden";
        // Hides the requirements for the upload
        document.getElementById(checkbox + "Notice").hidden = "hidden";
        // Removes the upload when the box is unchecked in order to prevent sending an unnecessary file
        document.getElementById(checkbox + "Upl").value = "";
        // Hides the upload preferred message
        document.getElementById("war-" + checkbox + "Upl").hidden = "hidden";
        // Clears errors since the box was unchecked and any files required are no longer required
        clearErrors(checkbox);


    }

}
// Function made to check the "Other" checkbox when the Other Input is selected
function OtherCheck() {
    // Checks the Other checkbox
    document.getElementById('otherChk').checked = true;

}
// Function to remove any typed input in the other input when the "Other checkbox is unchecked
function OtherUncheck() {
    // Removes any input in the other input box
    document.getElementById("otherInput").value = "";

}