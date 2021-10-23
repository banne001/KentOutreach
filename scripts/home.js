/**
 * Checks and shows intake form when the toggle is checked
 * Gets the text of the slides and bio descriptions from the server
 * and prints it out.
 */
$(document).ready(function(){
    $.post("getFormState.php", {}, function(result){
        console.log(result);
        if(result == "true"){
            addIntakeForm();
        } else {
            removeIntakeForm();
        }
    });
    $.ajax({url: "getBio.php", type: 'POST', dataType:'json', success: function(result){
        console.log(result);
        $("#bio").html(result.bio);
        $("#header1").html(result.header1);
        $("#sub1").html(result.sub1);
        $("#header2").html(result.header2);
        $("#sub2").html(result.sub2);
        $("#header3").html(result.header3);
        $("#sub3").html(result.sub3);
        }});

});

/**
 * show the elements that have links to the intake form
 */
function removeIntakeForm(){
    document.getElementById("intakeForm").classList.add("d-none");
    document.getElementById("navIntakeForm").classList.add("d-none");
    document.getElementById("noIntakeForm").classList.remove("d-none");


}
/**
 * hide the elements that have links to the intake form
 */
function addIntakeForm(){
    document.getElementById("intakeForm").classList.remove("d-none");
    document.getElementById("navIntakeForm").classList.remove("d-none");
    document.getElementById("noIntakeForm").classList.add("d-none");
}

urlPrefix = "http://java-chip.greenriverdev.com/DaysideLLC/Sprint/images/"



/**
 * collapse or expands the specified services to show requirements
 * @param buttonID gets the specific id of the button pressed
 */
function onClickToggle(buttonID) {

    if (document.getElementById(buttonID).src.split("/").pop().split(".")[0] == "unexpanded") {

        document.getElementById(buttonID).src = "images/expand.png";

    } else {

        document.getElementById(buttonID).src = "images/unexpanded.png";

    }

}

/**
 * Collapse or Expands all services to show requirements.
 * Changing the text content and the image icon when clicked.
 */
function switchExpand(){
    // Variables. Get expand button and image
    let desc = document.getElementsByClassName("multi-collapse");
    let btn = document.getElementById("expandButton");
    let expand = document.getElementsByClassName("expand");

    // console.log(btn.textContent);
    // Changing text context of the expand button to Collapse or Expand
    // and the image icon depending of the state of the button.
    if(btn.textContent == "Expand All Services"){
        btn.textContent = "Collapse All Services";
        changePic(expand, "images/expand.png", desc, "collapse in multi-collapse");
    } else{
        btn.textContent = "Expand All Services";
        changePic(expand, "images/unexpanded.png");
    }

}

/**
 * Changes all expand images to correspond with the
 * staues of the expand button
 * @param expand the class in which the picture resides in.
 * @param picTitle name of the location for the image being replaced
 */
function changePic(expand, picTitle, desc, classN ){
    // goes through all the elements with the expand class
    // and changes its img src to the picTitle.
    for(let i = 0; i < expand.length; i++) {
        desc[i].className = classN;
        let picture = expand[i].getElementsByTagName("img")[0];
        let src = picture.getAttribute('src');
        expand[i].getElementsByTagName("img")[0].src = picTitle;
    }
}
function changePic(expand, picTitle){
    // goes through all the elements with the expand class
    // and changes its img src to the picTitle.
    for(let i = 0; i < expand.length; i++) {
        let picture = expand[i].getElementsByTagName("img")[0];
        let src = picture.getAttribute('src');
        expand[i].getElementsByTagName("img")[0].src = picTitle;
    }
}





