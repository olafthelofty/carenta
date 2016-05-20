$(document).ready(function(){
    
    //append a heading option to end of list
    //with a null value, 
    //set color value to null (headings don't have a color)
    //if Heading checkbox is checked
    $("input[name='heading']").click(function(){
            if ($(this).is(':checked')) {      
                $('#parent-id')
                    .find('option')
                    .end()
                    .append('<option value= "">Set as Heading</option>')
                    .val('');
                $('#event-background-color').val('');
                } else {
                    var x = document.getElementById("parent-id");
                    if (x.length > 0) {
                        x.remove(x.length - 1);
                    }                        
                }                  
    });  
    
    $('.colorpick').colorpicker(); 
    
    $('#datepicker').datepicker("setDate", "0"); //"0" for current date 

    $("#datepicker").datepicker({
        beforeShowDay: DisableWeekDays,
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy/mm/dd",
        onSelect: function(dateText, inst) { 
            var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
            var dateString = $.datepicker.formatDate("yy-mm-dd", dateAsObject);
            //set data-selecteddate attribute on #addWeekTemplate button, on date change
            $("#addWeekTemplate").attr("data-selecteddate", dateString);        
        }
    });//.datepicker("setDate", new Date());

    $('#btnPicker').click(function () {
        $('#datepicker').datepicker('show');
    });  
 
});   

function DisableWeekDays(date) {
 
  var day = date.getDay();
 // If day == 1 through 7 then only allow day 0 ie Sunday
 if (day == 1 || day == 2 || day == 3 || day == 4 || day == 5 || day == 6 || day == 7) {
    
    return [false] ; 
    
} else { 
    
    return [true] ;
    
    }
  
} 