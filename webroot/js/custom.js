$(document).ready(function(){
    
    $('.colorpick').colorpicker();
    $('option[value=12]').attr('disabled', true);

    $("#datepicker").datepicker({
        beforeShowDay: DisableWeekDays,
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        onSelect: function(dateText, inst) { 
            var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
            var dateString = $.datepicker.formatDate("yy-mm-dd", dateAsObject);
            //set data-you attribute on #addWeekTemplate button, on date change
            $("#addWeekTemplate").attr("data-selecteddate", dateString);        
        }
    }).datepicker("setDate", new Date());

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