// Call this from the developer console and you can control both instances
var calendars = {};

$(document).ready(function(){
    
$("#eventdata").hide();
    
$('#calendar').fullCalendar({
    
    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
    
				resourceAreaWidth: 230,
				//defaultDate: '2016-01-07',
                defaultDate: moment(),
                allDayDefault: false,
				editable: true,
				aspectRatio: 2.5,
				scrollTime: '00:00',
				header: {
					left: 'promptResource today prev,next',
					center: 'title',
					right: 'timelineDay,timelineThreeDays,agendaWeek,month'
				},
				customButtons: {
					promptResource: {
						text: '+ room',
						click: function() {
							var title = prompt('Room name');
							if (title) {
								$('#calendar').fullCalendar(
									'addResource',
									{ title: title },
									true // scroll to the new resource?
								);
							}
						}
					}
				},
				defaultView: 'timelineDay',
				views: {
					timelineThreeDays: {
						type: 'timeline',
						duration: { days: 3 }
					}
				},
				resourceLabelText: 'Rooms',
//				resources: [
//					{ id: 'a', title: 'Auditorium A' },
//					{ id: 'b', title: 'Auditorium B', eventColor: 'green' },
//					{ id: 'c', title: 'Nights', eventColor: 'orange' },
//					{ id: 'd', title: 'Days', children: [
//						{ id: '100', title: '7.15am to 4.45pm', eventColor: 'green' },
//						{ id: 'd2', title: '7.15am to 2.00pm' }
//					] },
//					{ id: '101', title: 'Evenings', children: [
//						{ id: 'e1', title: '8.00pm to 00.00pm' },
//						{ id: 'e2', title: '5.15pm to 7.45pm' }
//					]  },
//					{ id: 's', title: 'Auditorium F', eventColor: 'red' },
//					{ id: '200', title: 'Auditorium G' },
//					{ id: 'h', title: 'Auditorium H' },
//					{ id: 'z', title: 'Auditorium Z' }
//				],
                resources: {
                    url: 'http://carenta.somervillehouse.co.uk/resources/feed'
                },
                events: {
                    url: 'http://carenta.somervillehouse.co.uk/events/feed'
               // color: 'yellow',    // an option!
                //textColor: 'blue',  // an option!
                },
//				events: [
//					{ id: '1', start: moment(), end: moment().add(3, 'days'), title: 'Graham Kindon', employee: 'poo' },
//					{ id: '2', resourceId: 'd1', start: '2016-01-07T07:15:00', end: '2016-01-07T22:00:00', title: 'Sally Carpenter' },
//					{ id: '3', resourceId: 'd', start: '2016-01-06', end: '2016-01-08', title: 'event 3' },
//					{ id: '4', resourceId: 'e', start: '2016-01-07T07:15:00', end: '2016-01-07T16:45:00', title: 'event 4' },
//					{ id: '5', resourceId: 'f', start: '2016-01-07T00:30:00', end: '2016-01-07T02:30:00', title: 'event 5', employee: 'poo' }
//				],
    
                  eventRender: function(event, element) { 
                        element.find('.fc-title').append(" " + event.employee);

                  },
                dayClick: function(date, allDay, jsEvent, view) {
                    $("#eventdata").show();
                    $("#eventdata").load("http://carenta.somervillehouse.co.uk/events/eventadd/"+allDay+"/"+ date,function(response, status, xhr){
$("#eventdata").html(response);
});
                },
//                element.qtip({
//                    content: event.description + '<br />' + event.start,
//                    style: {
//                        background: 'black',
//                        color: '#FFFFFF'
//                    },
//                    position: {
//                        corner: {
//                            target: 'center',
//                            tooltip: 'bottomMiddle'
//                        }
//                    }
//                });                  
   
             // }
			});    
    
    
//var repeatingEvents = [{
//    title:"My repeating event",
//    id: 1,
//    tip: 'hi',
//    start: '11:00', // a start time (10am in this example)
//    end: '14:00', // an end time (6pm in this example)
//    dow: [ 1, 4 ], // Repeat monday and thursday
//    ranges: [{ //repeating events are only displayed if they are within one of the following ranges.
//        start: moment().startOf('week'), //next two weeks
//        end: moment().endOf('week').add(14,'d'),
//    },{
//        start: moment('2016-02-01','YYYY-MM-DD'), //all of february
//        end: moment('2016-02-01','YYYY-MM-DD').endOf('month'),
//    }],
//}];
//
////emulate server
//var getEvents = function( start, end ){
//    return repeatingEvents;
//}
//
//$('#calendar').fullCalendar({
//    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
//    defaultDate: moment(),
//    header: {
//        left: 'prev,next today',
//        center: 'title',
//        right: 'month,agendaWeek,agendaDay'
//    },
//    defaultView: 'month',
//    eventRender: function(event, element, view){
//        
//        element.attr('title', event.tip);
//        
//        console.log(event.start.format());
//        return (event.ranges.filter(function(range){
//            return (event.start.isBefore(range.end) &&
//                    event.end.isAfter(range.start));
//        }).length)>0;
//    },
//    events: function( start, end, timezone, callback ){
//        var events = getEvents(start,end); //this should be a JSON request
//        
//        callback(events);
//    },
//});   
    
//    $('#calendar').fullCalendar({
//			header: {
//				left: 'prev,next today',
//				center: 'title',
//				right: 'month,agendaWeek,agendaDay'
//			},
//			defaultDate: '2016-02-21',
//			defaultView: 'month',
//			editable: true,
//			events: [
////				{
////					title: 'All Day Event',
////					start: '2014-06-01'
////				},
//				{
//					title: 'Long Eventtttttt',
//					//start: '2016-01-02',
//					//end: '2016-02-21',
//                    
//                    start: moment().startOf('week'), //next two weeks
//                    end: moment().endOf('week').add(7,'d'),
//                    dow: [ 1, 3, 4 ]//,
//				}//,
////				{
////					id: 999,
////					title: 'Repeating Event',
////					start: '2014-06-09T16:00:00'
////				},
////				{
////					id: 999,
////					title: 'Repeating Event',
////					start: '2014-06-16T16:00:00'
////				},
////				{
////					title: 'Meeting',
////					start: '2014-06-12T10:30:00',
////					end: '2014-06-12T12:30:00'
////				},
////				{
////					title: 'Lunch',
////					start: '2014-06-12T12:00:00'
////				},
////				{
////					title: 'Birthday Party',
////					start: '2014-06-13T07:00:00'
////				},
////				{
////					title: 'Click for Google',
////					url: 'http://google.com/',
////					start: '2014-06-28'
////				}
//			]
//		})
    
////CLNDR.js calendar code    
//
//    // Here's some magic to make sure the dates are happening this month.
//    var thisMonth = moment().format('YYYY-MM');
//    // Events to load into calendar
//    var eventArray = [
//        {
//            title: 'Multi-Day Event',
//            endDate: thisMonth + '-14',
//            startDate: thisMonth + '-10'
//        }, {
//            endDate: thisMonth + '-23',
//            startDate: thisMonth + '-21',
//            title: 'Another Multi-Day Event'
//        }, {
//            date: thisMonth + '-27',
//            title: 'Single Day Event'
//        }
//    ];
//    
//  var currentMonth = moment().format('YYYY-MM');
//  var nextMonth    = moment().add('month', 1).format('YYYY-MM');    
//    
//  var events = [
//    { date: currentMonth + '-' + '10', name: 'Graham Kingdon', shift: 'Nights' },
//    { date: currentMonth + '-' + '10', name: 'Graham Kingdon', shift: 'Days' },
//    { date: currentMonth + '-' + '10', name: 'Graham Kingdon', shift: 'Nights' },
//    { date: currentMonth + '-' + '10', name: 'Graham Kingdon', shift: 'Days' },      
//    { date: currentMonth + '-' + '19', name: 'Sarah Drew', shift: 'Eves' },
//    { date: currentMonth + '-' + '23', name: 'Sarah Kingdon', shift: 'Days' },
//    { date: nextMonth + '-' + '07',    name: 'Sally Carpenter', shift: 'Short Days' }
//  ];    
//
//    // The order of the click handlers is predictable. Direct click action
//    // callbacks come first: click, nextMonth, previousMonth, nextYear,
//    // previousYear, nextInterval, previousInterval, or today. Then
//    // onMonthChange (if the month changed), inIntervalChange if the interval
//    // has changed, and finally onYearChange (if the year changed).
// 
// calendars.clndr1 = $('.cal1').clndr({
//        template: $('#template-calendar').html(),
//        events: events,
//        clickEvents: {
//            click: function (target) {
//                console.log('Cal-1 clicked: ', target);
//            },
//            today: function () {
//                console.log('Cal-1 today');
//            },
//            nextMonth: function () {
//                console.log('Cal-1 next month');
//            },
//            previousMonth: function () {
//                console.log('Cal-1 previous month');
//            },
//            onMonthChange: function () {
//                console.log('Cal-1 month changed');
//            },
//            nextYear: function () {
//                console.log('Cal-1 next year');
//            },
//            previousYear: function () {
//                console.log('Cal-1 previous year');
//            },
//            onYearChange: function () {
//                console.log('Cal-1 year changed');
//            },
//            nextInterval: function () {
//                console.log('Cal-1 next interval');
//            },
//            previousInterval: function () {
//                console.log('Cal-1 previous interval');
//            },
//            onIntervalChange: function () {
//                console.log('Cal-1 interval changed');
//            }
//        },
//        multiDayEvents: {
//            singleDay: 'date',
//            endDate: 'endDate',
//            startDate: 'startDate'
//        },
//        showAdjacentMonths: true,
//        adjacentDaysChangeMonth: false
//    });
//    
//  //Bind all clndrs to the left and right arrow keys
//    $(document).keydown( function(e) {
//        // Left arrow
//        if (e.keyCode == 37) {
//            calendars.clndr1.back();
//        }
//
//        // Right arrow
//        if (e.keyCode == 39) {
//            calendars.clndr1.forward();
//        }
//    });
////===========================================================
//
//// DnD experiments
//// see https://jqueryui.com/droppable/#shopping-cart
//    
//var options = [
//        set0 = ['Option 1','Option 2'],
//        set1 = ['First Option','Second Option','Third Option']
//    ];
//
//function makeUL(array) {
//    // Create the list element:
//    var list = document.createElement('ul');
//
//    for(var i = 0; i < array[0].length; i++) {
//        // Create the list item:
//        var item = document.createElement('li');
//
//        // Set its contents:
//        item.appendChild(document.createTextNode(array[0][i]));
//
//        // Add it to the list:
//        list.appendChild(item);
//    }
//
//    // Finally, return the constructed list:
//    return list;
//}
//
//// Add the contents of options[0] to #foo:
//document.getElementById('shiftlist').appendChild(makeUL(options));
//$('#shiftlist ul').addClass('list-group');
//$('#shiftlist li').addClass('list-group-item');
//    
//    // dnd
//    $( "#shiftlist li" ).draggable(
//        {
//      appendTo: "body",
//      helper: "clone"
//    }
//    );
//    $( ".clndr-table td" ).droppable({
//      activeClass: "ui-state-default",
//      hoverClass: "ui-state-hover",
//      accept: ":not(.ui-sortable-helper)",
//      drop: function( event, ui ) {
//        $( this ).find( ".placeholder" ).remove();
//        $( "<span class='dnd btn btn-xs btn-info'></span>" ).text( ui.draggable.text() ).appendTo( this );
//           
//      }
//    }).sortable({
//      items: "li:not(.placeholder)",
//      sort: function() {
//        // gets added unintentionally by droppable interacting with sortable
//        // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
//        $( this ).removeClass( "ui-state-default" );
//      }
//    });
//    
//    $(".clndr-table td").click(function(){
//
//        $( this ).find( ".dnd" ).remove();
//
//    });
//    
//    //change cursor to hand
//    $('#shiftlist').css('cursor', 'pointer');
//    
});