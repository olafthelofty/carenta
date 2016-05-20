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
        inactive: 1500
    },
		//style: 'qtip-light'
        style: 'qtip-dark'
	}).qtip('api');
    
    // see http://www.jqueryajaxphp.com/fullcalendar-crud-with-jquery-and-php/
    
    var zone = "00:00";  //Change this to your timezone
    var empID = $('#patternevent').attr('data-id');

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
            displayEventTime: false,

            events: {url: 'http://carenta.somervillehouse.co.uk/events/viewfilteredeventsfeed?employee_id='+empID},
            // eventRender: function(event, element) { 
            //    element.find('.fc-title').append("&nbsp;" + event.resourcesTitle); 
            // }, 
            
            eventRender: function(event, element) {
                element.find(".fc-title").remove();
                element.find(".fc-time").remove();
                
                element.qtip({
                    content: event.title
                });
                
                var new_description = 
                    '<div style="color:BLACK">'  
                    + event.resourcesTitle + '&nbsp;'
                    + '<i>' + event.title + '</i>&nbsp;'
                    + '</div>'
                ;
                element.append(new_description);
            },
            
            local: true,
            nextDayThreshold: '00:00:00',
            
            header: {
                left: 'today prev,next',
                center: 'title',
                right: 'timelineDay,timelineThreeDays,agendaFourWeeks,month,timelineMnth,agendaWeek'
            },
            
            defaultView: 'month',
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
                    fixedWeekCount : true,
                    allDayText: 'Non working',
                    weekNumbers: true
                    
                }
            },
            resourceLabelText: 'Shift',
            
            resources: {
                url: 'http://carenta.somervillehouse.co.uk/resources/feed'
            },
            
			editable: false,
			droppable: false, 
			slotDuration: '00:15:00',
            //tooltip on hover
            // eventMouseover: function(event, jsEvent, view) {
            //     //var end = (event.end == null) ? event.start.format() : event.end.format();
            //     if (!event.end) { var end = event.start.format('DD-MM-YYYY HH:mm'); }else{ var end = event.end.format('DD-MM-YYYY HH:mm'); }
            //     var content = '<h3>'+event.title+'</h3>' + 
            //         '<p><b>Start:</b> '+event.start.format('DD-MM-YYYY HH:mm')+'<br />' + 
            //         '<p><b>End:</b> '+end+'</p>';

            //     tooltip.set({
            //         'content.text': content
            //     })
            //     .reposition(jsEvent).show(jsEvent);
            // },
            //tooltip on click
		    // eventClick: function(event, jsEvent, view) {
            //     if (!event.end) { var end = event.start.format('DD-MM-YYYY HH:mm'); }else{ var end = event.end.format('DD-MM-YYYY HH:mm'); }
            //     var content = '<h3>'+event.title+'</h3>' + 
            //         '<p><b>Start:</b> '+event.start.format('DD-MM-YYYY HH:mm')+'<br />' + 
            //         '<p><b>End:</b> '+end+'</p>';

            //     tooltip.set({
            //         'content.text': content
            //     })
            //     .reposition(jsEvent).show(jsEvent);
            // },
            // dayClick: function() { tooltip.hide() },
            // eventResizeStart: function() { tooltip.hide() },
            // eventDragStart: function() { tooltip.hide() },
            // viewDisplay: function() { tooltip.hide() },

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