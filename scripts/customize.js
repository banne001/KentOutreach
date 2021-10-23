// about us DOM
let edit = document.getElementById("edit");
let save = document.getElementById("save");
let text = document.getElementById("description");
let cancel = document.getElementById("cancel");
// about us buttons
edit.onclick=function(){editDescription()};
save.onclick= function (){saveDescription()};
cancel.onclick = function(){cancelDescription()};

// slide buttons
// edit
document.getElementById("editSlide1").onclick = function(){editSlides(1)};
document.getElementById("editSlide2").onclick = function(){editSlides(2)};
document.getElementById("editSlide3").onclick = function(){editSlides(3)};

// save
document.getElementById("saveSlide1").onclick = function(){saveSlides(1)};
document.getElementById("saveSlide2").onclick = function(){saveSlides(2)};
document.getElementById("saveSlide3").onclick = function(){saveSlides(3)};

// cancel
document.getElementById("cancelSlide1").onclick = function(){cancelSlides(1)};
document.getElementById("cancelSlide2").onclick = function(){cancelSlides(2)};
document.getElementById("cancelSlide3").onclick = function(){cancelSlides(3)};

// About Us Functions
function editDescription(){
    edit.classList.add("d-none");
    save.classList.remove("d-none");
    text.classList.remove("d-none");
    cancel.classList.remove("d-none");
}

function saveDescription(){
    let description = text.value;
    $.post("updateBio.php",
        {desc:description},
        function(result){
            $("#bio").html(result);
        });
    edit.classList.remove("d-none");
    save.classList.add("d-none");
    text.classList.add("d-none");
    cancel.classList.add("d-none");
}

function cancelDescription(){
    edit.classList.remove("d-none");
    save.classList.add("d-none");
    text.classList.add("d-none");
    cancel.classList.add("d-none");
}
// Slides Functions
function editSlides(slideNum){
    console.log(typeof slideNum);
    document.getElementById("editSlide" + slideNum).classList.add("d-none");
    document.getElementById("saveSlide" + slideNum).classList.remove("d-none");
    document.getElementById("slideHeader" + slideNum).classList.remove("d-none");
    document.getElementById("slideSub" + slideNum).classList.remove("d-none");

    document.getElementById("cancelSlide" + slideNum).classList.remove("d-none");
}

function saveSlides(slideNum){
    let header = document.getElementById("slideHeader" + slideNum);
    let sub = document.getElementById("slideSub" + slideNum);
    console.log(header.value);
    console.log(sub.value);

    $.ajax({
            url: "updateSlides.php",
            type: 'POST',
            data: {header: header.value, sub: sub.value, id: slideNum},
            dataType: 'json',
            success: function(result){
                console.log(result);
                $("#header" + slideNum).html(result.header);
                $("#sub" + slideNum).html(result.sub);
            }
    });
    document.getElementById("editSlide" + slideNum).classList.remove("d-none");
    document.getElementById("saveSlide" + slideNum).classList.add("d-none");
    header.classList.add("d-none");
    sub.classList.add("d-none");
    document.getElementById("cancelSlide" + slideNum).classList.add("d-none");
}

function cancelSlides(slideNum){
    document.getElementById("editSlide" + slideNum).classList.remove("d-none");
    document.getElementById("saveSlide" + slideNum).classList.add("d-none");
    document.getElementById("slideHeader" + slideNum).classList.add("d-none");
    document.getElementById("slideSub" + slideNum).classList.add("d-none");
    document.getElementById("cancelSlide" + slideNum).classList.add("d-none");
}