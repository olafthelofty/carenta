$(document).ready(function(){
    
    $("#patternRefresh").click(function(){       
        patternRefresh();
    });
    
    $("#patternApply").click(function(){  
        var empID = $(this).attr('data-id');
        patternApply(empID);
    
    });
    
    $("#testStuff").click(function(){ testStuff();});
    
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

    function patternApply(employeeID){
        //delete current events for this employee
        // $.ajax({
		// 	url: '../../php/process.php',
        //     //url: 'http://carenta.somervillehouse.co.uk/events/patternevent',
	    //     type: 'POST', // Send post data
	    //     data: {type: 'delete', empID: employeeID},
	    //     //async: false,
	    //     success: function(s){
	    //     	//freshevents = s;
        //         console.log(s)
	    //     }
		// });

        //apply and save new events from current pattern
        var results;

        $.getJSON('http://carenta.somervillehouse.co.uk/patterns/feed?employee_id=' + employeeID, function(data){
            $.each(data, function(key, val) {

                // create a later.js schedule using recur
                var sched = later.schedule(later.parse.recur()  
                //on week day_of_week                      every n weeks          start from
                .on(val.day_of_week).dayOfWeek().every(1).weekOfYear()), start = new Date('2016,03,26');  

                results = sched.next(10, start);

                //create newEvents array to hold entire schedule
                //var newEvents = [];
                for (var i = 0; i < results.length; i++) {
                    
                        var allDayVal;
                    
                        if (val.resource_id == 9)
                        {allDayVal = true;console.log(allDayVal);}
                        else
                        {allDayVal = false;console.log(allDayVal);}
                    
                    //var event = new Object();
                    var data = {
                    
                   // event = {           
                        "data['Events']['startdate']": new Date(moment(results[i].setHours(parseInt(moment(val.starttime).utc().format("HH")), parseInt(moment(val.starttime).utc().format("mm"))))),
                        "data['Events']['enddate']" : new Date(moment(results[i].setHours(parseInt(moment(val.endtime).utc().format("HH")), parseInt(moment(val.endtime).utc().format("mm"))))),
 
                        "data['Events']['title']" :val.employee_name,
                        "data['Events']['allDay']" : allDayVal,
                        "data['Events']['resource_id']" : val.resource_id,
                        "data['Events']['pattern_id']" : val.pattern_id,
                        "data['Events']['employee_id']": val.employee_id,
                        "data['Events']['event_type']" : val.event_type,
                        "data['Events']['zone']" : "00:00"  //Change this to your timezone
                    };
                    //newEvents.push(event);

                }

                console.log(JSON.stringify(data));
                
                // DO NOT DELETE!!!!   
                $.ajax({
                    type: 'POST',
                    url: 'http://carenta.somervillehouse.co.uk/events/patternevent/',
                    data: data
                })
                .done( function( data ) {
                    console.log( data );
                })
                .fail(function( data ) {
                    console.log( data );
                });
            
                // END DO NOT DELETE!!!!

            });

        });
    }

});    