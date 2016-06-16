$(document).ready(function(){
    
    $("#patternRefresh").click(function(){       
        patternRefresh();
    });
    
    $("#addWeekTemplate").click(function(){ 
         
        var empID = $(this).attr('data-id');
        //var selecteddate = $(this).attr('data-selecteddate');
        
        var selectedstartdate = $(this).attr('data-selectedstartdate');
        var selectedenddate = $(this).attr('data-selectedenddate');
        
        addWeekTemplate(empID, selectedstartdate, selectedenddate);
    
    });
    
    $("#newPattern").click(function(){ 
         
        var empID = $(this).attr('data-id');
        //var selecteddate = $(this).attr('data-selecteddate');
        
        var selectedstartdate = $(this).attr('data-selectedstartdate');
        var selectedenddate = $(this).attr('data-selectedenddate');
        
        newPattern(empID, selectedstartdate, selectedenddate);
    
    });        
 
    var empID = $("#annualleavesummary").attr('data-id');
    //var selecteddate = $(this).attr('data-selecteddate');
    getAnnualLeave(empID);      

}); 

// custom calendar functions 

 function patternRefresh (){
        $('#calendar').fullCalendar('removeEvents');
        getFreshEvents();
        $.toaster({ priority : 'success', title : 'Calendar:', message : 'Updated' });
    }
   
function randomToast ()
    {
        var priority = 'success';
        var title    = 'Success';
        var message  = 'It worked!';

        $.toaster({ priority : priority, title : title, message : message });
    }
    
var empID = $('#patternApply').attr('data-id');

function getFreshEvents(){
    $.ajax({
        url: '../../php/process.php',
        type: 'POST', // Send post data
        data: 'type=fetch&employeeID='+empID,
        async: false,
        success: function(s){
            freshevents = s;
        }
    });
    $('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
}

function addWeekTemplate(employeeID, startdate, enddate){
    //create new set of patterns for passed employee and selected date
    $.ajax({
        url: 'http://carenta.somervillehouse.co.uk/patterns/addWeekTemplate?employee_id=' + employeeID + '& selectedstartdate=' + selectedstartdate  + '& selectedenddate=' + selectedenddate,
        type: 'POST', // Send post data
        success: function(data){
            //console.log(data);
            location.reload();
        }
    });
}

function newPattern(employeeID, selectedstartdate, selectedenddate){
    //create new set of patterns for passed employee and selected date
    $.ajax({
        url: 'http://carenta.somervillehouse.co.uk/patternParents/newPattern?employee_id=' + employeeID + '& selectedstartdate=' + selectedstartdate  + '& selectedenddate=' + selectedenddate,
        type: 'POST', // Send post data
        success: function(data){
            //console.log(data);
            location.reload();
        }
    });
}
    
function getAnnualLeave(employeeID){
    //calculate annual leave for passed employee_id
    $.ajax({
        url: 'http://carenta.somervillehouse.co.uk/events/annualleave?employee_id=' + employeeID,
        type: 'POST', // Send post data
        success: function(data){
            console.log(data);
            //location.reload();
            //alert(data);
            $('#annualleavesummary').html(data);
        }
    });
}