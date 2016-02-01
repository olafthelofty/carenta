// Call this from the developer console and you can control both instances
var calendars = {};

$(document).ready(function(){
   
     $( ".datepicker" ).datepicker({
                    dateFormat: 'dd/mm/yy',
                    changeMonth: true,
                    changeYear: true,
           // minDate: "-70Y", 
        //maxDate: "-15Y",
        yearRange: "1942:1997"
                    //altFormat: 'yyyy/mm/dd'
     });
    
//CLNDR.js calendar code    

    // Here's some magic to make sure the dates are happening this month.
    var thisMonth = moment().format('YYYY-MM');
    // Events to load into calendar
    var eventArray = [
        {
            title: 'Multi-Day Event',
            endDate: thisMonth + '-14',
            startDate: thisMonth + '-10'
        }, {
            endDate: thisMonth + '-23',
            startDate: thisMonth + '-21',
            title: 'Another Multi-Day Event'
        }, {
            date: thisMonth + '-27',
            title: 'Single Day Event'
        }
    ];
    
  var currentMonth = moment().format('YYYY-MM');
  var nextMonth    = moment().add('month', 1).format('YYYY-MM');    
    
  var events = [
    { date: currentMonth + '-' + '10', name: 'Graham Kingdon', shift: 'Nights' },
    { date: currentMonth + '-' + '10', name: 'Graham Kingdon', shift: 'Days' },
    { date: currentMonth + '-' + '10', name: 'Graham Kingdon', shift: 'Nights' },
    { date: currentMonth + '-' + '10', name: 'Graham Kingdon', shift: 'Days' },      
    { date: currentMonth + '-' + '19', name: 'Sarah Drew', shift: 'Eves' },
    { date: currentMonth + '-' + '23', name: 'Sarah Kingdon', shift: 'Days' },
    { date: nextMonth + '-' + '07',    name: 'Sally Carpenter', shift: 'Short Days' }
  ];    

    // The order of the click handlers is predictable. Direct click action
    // callbacks come first: click, nextMonth, previousMonth, nextYear,
    // previousYear, nextInterval, previousInterval, or today. Then
    // onMonthChange (if the month changed), inIntervalChange if the interval
    // has changed, and finally onYearChange (if the year changed).
 
 calendars.clndr1 = $('.cal1').clndr({
        template: $('#template-calendar').html(),
        events: events,
        clickEvents: {
            click: function (target) {
                console.log('Cal-1 clicked: ', target);
            },
            today: function () {
                console.log('Cal-1 today');
            },
            nextMonth: function () {
                console.log('Cal-1 next month');
            },
            previousMonth: function () {
                console.log('Cal-1 previous month');
            },
            onMonthChange: function () {
                console.log('Cal-1 month changed');
            },
            nextYear: function () {
                console.log('Cal-1 next year');
            },
            previousYear: function () {
                console.log('Cal-1 previous year');
            },
            onYearChange: function () {
                console.log('Cal-1 year changed');
            },
            nextInterval: function () {
                console.log('Cal-1 next interval');
            },
            previousInterval: function () {
                console.log('Cal-1 previous interval');
            },
            onIntervalChange: function () {
                console.log('Cal-1 interval changed');
            }
        },
        multiDayEvents: {
            singleDay: 'date',
            endDate: 'endDate',
            startDate: 'startDate'
        },
        showAdjacentMonths: true,
        adjacentDaysChangeMonth: false
    });
    
  //Bind all clndrs to the left and right arrow keys
    $(document).keydown( function(e) {
        // Left arrow
        if (e.keyCode == 37) {
            calendars.clndr1.back();
        }

        // Right arrow
        if (e.keyCode == 39) {
            calendars.clndr1.forward();
        }
    });
//===========================================================

// DnD experiments
// see https://jqueryui.com/droppable/#shopping-cart
    
 $( "#catalog" ).accordion();
    $( "#catalog li" ).draggable({
      appendTo: "body",
      helper: "clone"
    });
    $( ".clndr-table td" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
        $( this ).find( ".placeholder" ).remove();
        $( "<span class='dnd btn btn-xs btn-info'></span>" ).text( ui.draggable.text() ).appendTo( this );
      
          
      }
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        // gets added unintentionally by droppable interacting with sortable
        // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
        $( this ).removeClass( "ui-state-default" );
      }
    });
    
    $(".clndr-table td").click(function(){

        $( this ).find( ".dnd" ).remove();

    });    
    
});