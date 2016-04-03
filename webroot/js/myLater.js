$(document).ready(function(){
    
    $("#patternRefresh").click(function(){
        
        $('#calendar').fullCalendar('removeEvents');
        getFreshEvents();
        $.toaster({ priority : 'success', title : 'Calendar:', message : 'Updated' });

    });
    
    $("#patternApply").click(function(){ 
        var empID = $(this).attr('data-id');
        patternApply(empID);
    
    });
    
    $("#testStuff").click(function(){ testStuff();});
   
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
        $.ajax({
			url: '../../php/process.php',
	        type: 'POST', // Send post data
	        data: {type: 'delete', empID: employeeID},
	        //async: false,
	        success: function(s){
	        	//freshevents = s;
                console.log("good")
	        }
		});

        //apply and save new events from current pattern
        var results;

        $.getJSON('http://carenta.somervillehouse.co.uk/patterns/feed?employee_id=' + employeeID, function(data){
            $.each(data, function(key, val) {

                //create a later.js schedule
                var sched = later.schedule(later.parse.recur()
                //.on(val.day_of_week).dayOfWeek().every(val.weekOfYear).weekOfYear().startingOn(val.startingOn)), start = new Date('2016,03,22');
                .on(val.day_of_week).dayOfWeek().every(val.weekOfYear).weekOfYear()), start = new Date('2016,03,27');

                results = sched.next(10, start);

                //create newEvents array to hold entire schedule
                var newEvents = [];
                for (var i = 0; i < results.length; i++) {
                    
                        var allDayVal;
                    
                        if (val.resource_id == 9)
                        {allDayVal = true;console.log(allDayVal);}
                        else
                        {allDayVal = false;console.log(allDayVal);}
                    
                    var event = new Object();
                    
                    event = {
                        
                        //  startdate:moment(results[i]).transform(
                        // 'YYYY-MM-DD ' 
                        // + parseInt(moment(val.starttime).format("HH")) 
                        // + ':' 
                        // + parseInt(moment(val.starttime).format("mm")) 
                        // + ':00'
                        // ), 
                        
                        startdate: new Date(moment(results[i].setHours(parseInt(moment(val.starttime).utc().format("HH")), parseInt(moment(val.starttime).utc().format("mm"))))),
                        enddate: new Date(moment(results[i].setHours(parseInt(moment(val.endtime).utc().format("HH")), parseInt(moment(val.endtime).utc().format("mm"))))),
 
                        title: val.employee_name,
                        allDay: allDayVal,
                        resource_id: val.resource_id,
                        pattern_id: val.pattern_id,
                        employee_id: val.employee_id,
                        event_type: val.event_type,
                        zone: "00:00"  //Change this to your timezone
                    };
                    newEvents.push(event);

                }

                console.log(newEvents);
                //console.log(allDayVal);
                
             // DO NOT DELETE!!!!
                    
                $.ajax({
                    url: '../../php/process.php',
                    //data: 'type=new&title='+title+'&startdate='+start+'&zone='+zone,
                    data: { type:'patternevent', empID: val.employee_id, newEvents: newEvents },
                    type: 'POST',
                    dataType: 'json',
                    success: function(response){
                        event.id = response.eventid;
                        $('#calendar').fullCalendar('updateEvent', newEvents);
                        getFreshEvents();
                        
                    },
                    error: function(e){
                        console.log(e.responseText);
                        //console.log('go away');
                    }
              });
            
            // END DO NOT DELETE!!!!

            });

        });
    }

});    