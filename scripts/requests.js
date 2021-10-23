/**
 * Checks the server if the form should be on or off
 * then sets the toggle on if it is checked 
 * and off it is unchecked
 */
$(document).ready(function(){
    $.post("getFormState.php", {}, function(result){
        console.log(result);
        if(result == "true"){
            $('#toggleForm').prop("checked", true);
        }else{
            $('#toggleForm').prop("checked", false);
        }
    });

});
/**
 * Updates the server to checked or unchecked. And
 * changes the background of the row if it is checked.
 */
$('.contacted').on('change', function(){
    let trId = "#t" + this.id;
    let check = this.checked;
    if($("#" + this.id).is(":checked")){
        $(trId).css({background : 'tan'});
    } else {
        $(trId).css({background : ''});
    }
    $.post("contactChecked.php", { check: check, id: this.id});
})


/**
 * Updates the form state in the server to either checked 
 * or unchecked
 */
$('#toggleForm').on('change', function(){
    let state = "";
    if($('#toggleForm').is(":checked")){
        state = "CHECKED"
        console.log("CHECKED");
    }else{
        state = "UNCHECKED"
        console.log("UNCHECKED");
    }
    $.post("updateFormState.php",
        {state: state});
});

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-range-pre": function ( a ) {
        var monthArr = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return monthArr.indexOf(a);
    },
    "date-range-asc": function ( a, b ) {
        return ((a < b) ? -1 : ((a > b) ? 1 : 0));
    },
    "date-range-desc": function ( a, b ) {
        return ((a < b) ? 1 : ((a > b) ? -1 : 0));
    }
} );

$('#requests-table').DataTable({
    "columnDefs" : [{"targets":1, "type":"date-eu"}],
    order: [[ 0, "desc" ]],
    scrollX: true,
    "bSortClasses": false
} );