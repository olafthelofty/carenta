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
    //start = new Date('2016,03,22');
    
    var results;
    
    $.getJSON('http://carenta.somervillehouse.co.uk/patterns/feed', function(data){
        $.each(data, function(key, val) {
            
            console.log(data);
            
            
//            var sched = later.schedule(later.parse.recur()
//            .on(val.day_of_week).dayOfWeek().every(val.weekOfYear).weekOfYear().startingOn(val.startingOn).on('07:15:00').time()
//            .and()
//            .on(val.day_of_week).dayOfWeek().every(val.weekOfYear).weekOfYear().startingOn(val.startingOn).on('17:30:00').time()), start = new Date('2016,03,22');
            
            var sched = later.schedule(later.parse.recur()
            .on(val.day_of_week).dayOfWeek().every(val.weekOfYear).weekOfYear().startingOn(val.startingOn)), start = new Date('2016,03,22');
            
            
            
            //results = later.schedule(sched).next(10, start);
            //results = later.schedule(sched).next(10);
            //results = JSON.stringify(later.schedule(sched).next(10, start));
            
            results = sched.next(10, start);
            //console.log(results);
            //console.log($.type(results));
            var newEvents = [];
            for (var i = 0; i < results.length; i++) {
                
                var event = new Object();
                event = {
                    title: val.night_shift,
                    start: new Date(results[i]),
                    //end: new Date(results[i].getTime() + diff*60000),
                    end: new Date(results[i].setMinutes(results[i].getMinutes() + 450)),
                    allDay: false,
                    textColor: 'black'
                };
                newEvents.push(event);
   
            }
            
//              // sched for minute equal to 1,2, or 3
//              var sched1 = later.schedule(later.parse.recur().on(1,2,3).minute()),
//                  start = new Date('2013-05-22T10:22:00Z');
//
//              // get the next range
//              var jim = sched1.nextRange(1, start);
//            
            console.log(newEvents);
            console.log($.type(newEvents));
//            
            
            //console.log($.type(results));
//            var events = [];
//            var event = {};
//            var keys = [];
//            var values = $.parseJSON(results);
//            
//            for (var i = 0; i < values.length; i++) {
//               if (i % 2 == 0)
//                    {
//                        keys.push('startdate');
//                    }
//                else
//                    {
//                        keys.push('enddate');
//                    }
//                
//            }
            
            //console.log(keys);

//            function toObject(keys, vals) {
//              return keys.length === vals.length ? keys.reduce(function(obj, key, index) {
//                obj[key] = vals[index];
//                return obj;
//              }, {}) : null;
//            }
            
           //console.log(toObject(keys, values));
                
            //console.log(results);
            
//            //$.each(results, function(i) {
//                $.each(results, function(i, obj) {
//                     if (i % 2 == 0)
//                        {
//                            event.startdate = obj;
//                        }
//                    else
//                        {
//                            event.enddate = obj;
//                        }
//
//                    //event.employee_id = val.employee_id;
//                    //event.allDay = 'false';
//                    //events.push({event: event});
//                    events = event;
//            
//                });
            
            //});

            //console.log(events);
            //console.log($.type(event));
     
        });
        
        processResults(results);
    });
    
    function processResults(results){
//        var assoc = [];
//        var results = $.parseJSON(results);
//        
//        $.each(results, function(i, obj) {
//            if (i % 2 == 0)
//            {assoc.push({id:100, start_date:obj});}
//            else
//            {assoc.push({id:200, end_date:obj});}
//        });
//        
//        console.log(assoc);
//        console.log($.type(assoc));

    };

});    