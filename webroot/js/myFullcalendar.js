// Call this from the developer console and you can control both instances
var calendars = {};

$(document).ready(function(){

    var tooltip = $('<div/>').qtip({
		id: 'calendar',
		prerender: true,
		content: {
			text: ' ',
			title: {
				button: false
			}
		},
		position: {
			my: 'bottom center',
			at: 'top center',
			target: 'mouse',
			viewport: $('#calendar'),
			adjust: {
				mouse: false,
				scroll: false
			}
		},
    show: 'click',
    hide: {
        event: false,
        inactive: 1000
    },
		//style: 'qtip-light'
        style: 'qtip-dark'
	}).qtip('api');
    
//$("#eventdata").hide();
//    
//$('#calendar').fullCalendar({
    
    // see http://www.jqueryajaxphp.com/fullcalendar-crud-with-jquery-and-php/
    
    var zone = "00:00";  //Change this to your timezone
    var empID = $('#patternApply').attr('data-id');

	$.ajax({
		url: '../../php/process.php',
        type: 'POST', // Send post data
        data: 'type=fetch&employeeID='+empID,         
        //dataType: 'json',
        async: false,
        success: function(s){
            
        	json_events = s;
            
        }
	});

	var currentMousePos = {
	    x: -1,
	    y: -1
	};
		jQuery(document).on("mousemove", function (event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
    });

		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events .fc-event').each(function() {

			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});


		/* initialize the calendar
		-----------------------------------------------------------------*/

		$('#calendar').fullCalendar({
            
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
            resourceAreaWidth: 160,
            defaultDate: moment(),
            allDayDefault: false,
            aspectRatio: 2.5,
            scrollTime: '00:00',   
            
			//events: JSON.parse(json_events),
            events: {url: 'http://carenta.somervillehouse.co.uk/events/viewalleventsfeed'},
            eventRender: function(event, element) { 
                element.find('.fc-title').append("<br/>" + event.resourcesTitle); 
            }, 
			//events: [{"id":"14","title":"New Event","start":"2015-01-24T16:00:00+04:00","allDay":false}],
			//utc: true,
            local: true,
            nextDayThreshold: '00:00:00',
            
            header: {
                left: 'today prev,next',
                center: 'title',
                right: 'timelineDay,timelineThreeDays,agendaFourWeeks,month,timelineMnth'
            },
            
            defaultView: 'timelineDay',
            views: {
                timelineThreeDays: {
                    type: 'timeline',
                    duration: { days: 3 }
                },
                timelineMnth: {
                    type: 'timelineMonth',
                    duration: { days: 7 },
                    buttonText: '1 week',
                    allDay: 'Non working',
                },
                 agendaFourWeeks: {
                    type: 'month',
                    duration: { weeks: 4 },
                    buttonText: '4 Weeks',
                    fixedWeekCount : false,
                    allDayText: 'Non working'
                }
            },
            resourceLabelText: 'Shift',
            
            resources: {
                url: 'http://carenta.somervillehouse.co.uk/resources/feed'//,
                //eventBackgroundColor: 
            },
            
			editable: true,
			droppable: true, 
			slotDuration: '00:15:00',
			eventReceive: function(event){
				var title = event.title;
				var start = event.start.format("YYYY-MM-DD[T]HH:mm:SS");
                var end = event.end.format("YYYY-MM-DD[T]HH:mm:SS");

                //var start = moment(event.start).format("DD-MM-YYYY HH:mm:ss");
				$.ajax({
		    		url: '../../php/process.php',
		    		data: 'type=new&title='+title+'&startdate='+start+'&enddate='+end+'&zone='+zone,
		    		type: 'POST',
		    		dataType: 'json',
		    		success: function(response){
		    			event.id = response.eventid;
		    			$('#calendar').fullCalendar('updateEvent',event);
		    		},
		    		error: function(e){
		    			console.log(e.responseText);

		    		}
		    	});
				$('#calendar').fullCalendar('updateEvent',event);
				console.log(event);
			},
			eventDrop: function(event, delta, revertFunc) {
		        var title = event.title;
		        var start = event.start.format();
		        var end = (event.end == null) ? start : event.end.format();

		        $.ajax({
					url: '../../php/process.php',
					data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
					type: 'POST',
					dataType: 'json',
					success: function(response){
						if(response.status != 'success')		    				
						revertFunc();
					},
					error: function(e){		    			
						revertFunc();
						alert('Error processing your request: '+e.responseText);
					}
				});
		    },
            eventMouseover: function(event, jsEvent, view) {
                //var end = (event.end == null) ? event.start.format() : event.end.format();
                var content = '<h3>'+event.title+'</h3>' + 
                    '<p><b>Start:</b> '+event.start.format()+'<br />' + 
                    '<p><b>End:</b> '+event.end.format()+'</p>';

                tooltip.set({
                    'content.text': content
                })
                .reposition(jsEvent).show(jsEvent);
            },
		    // eventClick: function(event, jsEvent, view) {
            //     var end = (event.end == null) ? event.start.format() : event.end.format();
            //     var content = '<h3>'+event.title+'</h3>' + 
            //         '<p><b>Start:</b> '+event.start.format()+'<br />' + 
            //         '<p><b>End:</b> '+end+'</p>';

            //     tooltip.set({
            //         'content.text': content
            //     })
            //     .reposition(jsEvent).show(jsEvent);
            // },
            dayClick: function() { tooltip.hide() },
            eventResizeStart: function() { tooltip.hide() },
            eventDragStart: function() { tooltip.hide() },
            viewDisplay: function() { tooltip.hide() },
			eventResize: function(event, delta, revertFunc) {
				console.log(event);
				var title = event.title;
				//var end = event.end.format();
                var end = (event.end == null) ? start : event.end.format();
				var start = event.start.format();
  
                $.ajax({
				    		url: '../../php/process.php',
				    		data: 'type=resetdate&title='+title+'&start='+start+'&end='+end+'&eventid='+event.id,
				    		type: 'POST',
				    		dataType: 'json',
				    		success: function(response){	
				    			if(response.status == 'success')			    			
		              				$('#calendar').fullCalendar('updateEvent',event);
				    		},
				    		error: function(e){
				    			alert('Error processing your request: '+e.responseText);
				    		}
				    	});
		       // update(title,start,end,event.id);
		    },
			eventDragStop: function (event, jsEvent, ui, view) {
			    if (isElemOverDiv()) {
			    	var con = confirm('Are you sure to delete this event permanently?');
			    	if(con == true) {
						$.ajax({
				    		url: '../../php/process.php',
				    		data: 'type=remove&eventid='+event.id,
				    		type: 'POST',
				    		dataType: 'json',
				    		success: function(response){
				    			console.log(response);
				    			if(response.status == 'success'){
				    				$('#calendar').fullCalendar('removeEvents');
            						getFreshEvents();
            					}
				    		},
				    		error: function(e){	
				    			alert('Error processing your request: '+e.responseText);
				    		}
			    		});
					}   
				}
			}
		});

	function getFreshEvents(){
		$.ajax({
			url: '../../php/process.php',
	        type: 'POST', // Send post data
	        data: 'type=fetch',
	        async: false,
	        success: function(s){
	        	freshevents = s;
	        }
		});
        $('#calendar').fullCalendar('removeEvents');
		$('#calendar').fullCalendar('addEventSource', JSON.parse(freshevents));
	}


	function isElemOverDiv() {
        var trashEl = jQuery('#trash');

        var ofs = trashEl.offset();

        var x1 = ofs.left;
        var x2 = ofs.left + trashEl.outerWidth(true);
        var y1 = ofs.top;
        var y2 = ofs.top + trashEl.outerHeight(true);

        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
            currentMousePos.y >= y1 && currentMousePos.y <= y2) {
            return true;
        }
        return false;
    }

});