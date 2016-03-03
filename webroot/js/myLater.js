$(document).ready(function(){

    // create the desired schedule
    
    //every 2nd Sunday starting after 1 week
    //var sched = later.parse.recur().on(1).dayOfWeek().every(2).weekOfYear().startingOn(2);
    
    //every 2nd Saturday starting after 1 week
    //var sched = later.parse.recur().on(7).dayOfWeek().every(2).weekOfYear().startingOn(2);
    var sched = later.parse.recur()
            .on(7).dayOfWeek().every(2).weekOfYear().startingOn(2).on('07:15:00').time()
        .and()
            .on(7).dayOfWeek().every(2).weekOfYear().startingOn(2).on('17:30:00').time();
    
    
    //every Monday and Thursday
    //var sched = later.parse.recur().on(2,5).dayOfWeek().every(1).weekOfYear().on(1,2,3).minute();
    
    // sched for minute equal to 1,2, or 3
    //var sched = later.schedule(later.parse.recur().on(1,2,3).minute()),
    
    //automatically allows for BST
    start = new Date('2016,03,22');

    // get the next range
    //sched.nextRange(1, start);

    // calculate the next n occurrences using local time
    //later.date.localTime();
    //var results = sched.next(10, start);
    var results = later.schedule(sched).next(10, start);
    
    //alert(later.time.start(start));

    for (var i = 0; i < results.length; i++) {
      
        $('<p>' + results[i].toLocaleString() + '</p>').appendTo("#later");

    }

});    