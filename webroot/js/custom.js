$(document).ready(function(){

$('#Autocomplete').autocomplete({
  source:'/employees/search/',
  select: function (event, ui){
    //alert("id=" + ui.item.value);

    $.ajax({
        url: 'http://carenta.somervillehouse.co.uk/employees/view/' + ui.item.value,
        type: 'POST', // Send post data
        success: function(data){
            console.log(data);
            //on success redirect to employee result
            $(location).attr('href', 'http://carenta.somervillehouse.co.uk/employees/view/' + ui.item.value)
        }
    });

    },
  minLength: 1
    });

$("#Autocomplete").keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if (keycode == '13') {
    event.preventDefault();
    event.stopPropagation();    
  }
});    
    
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

    $("#datepickerStart_from").datepicker({ 
        beforeShowDay: DisableWeekDays,
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy/mm/dd",
        onSelect: function(dateText, inst) { 
            
            // Check if _until exists and auto set mindate
            if($("inst.id:contains(_from)")){
                $("#"+inst.id.replace("Start_from", "End_until")).datepicker("option", "minDate", dateText);
            }    
            
            var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
            var dateString = $.datepicker.formatDate("yy-mm-dd", dateAsObject);
            //set data-selecteddate attribute on #addWeekTemplate button, on date change
            //$("#addWeekTemplate").attr("data-selecteddate", dateString); 
            $("#addWeekTemplate").attr("data-selectedstartdate", dateString); 
            $("#newPattern").attr("data-selectedstartdate", dateString);  
        }      
    })//.tooltip({ show: { delay: 0 }, position: { my: "left+15 center", at: "top center" }
    //});
    
    $("#datepickerEnd_until").datepicker({ 
        beforeShowDay: DisableWeekDays,
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy/mm/dd",
        onSelect: function(dateText, inst) { 
            
            var dateAsObject = $(this).datepicker( 'getDate' ); //the getDate method
            var dateString = $.datepicker.formatDate("yy-mm-dd", dateAsObject);
            //set data-selecteddate attribute on #addWeekTemplate button, on date change
            //$("#addWeekTemplate").attr("data-selecteddate", dateString); 
            $("#addWeekTemplate").attr("data-selectedenddate", dateString);
            $("#newPattern").attr("data-selectedenddate", dateString);     
        }
    })//.tooltip({ show: { delay: 0 }, position: { my: "left+15 center", at: "top center" }
    //});  

    $('#btnPickerEnd').click(function () {
        $('#datepickerEnd_until').datepicker('show');
    });
    $('#btnPickerStart').click(function () {
        $('#datepickerStart_from').datepicker('show');
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