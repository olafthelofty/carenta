$(document).ready(function () {
    
//  // Define a set of tasks
//  var tasks = [
//    {id: 1, duration: 60, resources: [['A','B']], available: later.parse.text('every weekday')},
//    {id: 2, duration: 30, dependsOn: [1], resources: ['A']},
//    {id: 4, duration: 30, dependsOn: [1], resources: [['A','B']]}
//  ];
//
//  // Define a set of resources
//  var resources = [
//    {id: 'A', available: later.parse.text('after 10:00am and before 2:00pm')},
//    {id: 'B', available: later.parse.text('after 10:00am and before 2:00pm')}
//  ];
//
//  // Create the schedule for all of the tasks
//  var s = schedule.create(tasks, resources); 
//  for(var id in s.scheduledTasks) {
//      var st = s.scheduledTasks[id];
//      console.log(st);
//      document.write('<h2>' + id + '</h2>');
//      document.write('<p><b>Duration:</b> ' + st.duration + ' mins</p>');
//      document.write('<p><b>Start:</b> ' + new Date(st.earlyStart).toLocaleString() + '</p>');
//      document.write('<p><b>Finish:</b> ' + new Date(st.earlyFinish).toLocaleString() + '</p>');
//  }  
 

//    // We'll use the Later text parser to create schedules that are readable
//    var p = later.parse.text;
//
//    // Step 1: Define our reservations (tasks)
//    var tasks = [
//      {id: '7:15am to 5:00pm', duration: 585, resources: [['Bob']]},
//      {id: 'Mike', duration: 2, resources: (['7:15am to 5:00pm'])},
//      {id: 'Frank', duration: 8, resources: (['7:15am to 5:00pm'])},
//      {id: 'John', duration: 3, resources: (['7:15am to 5:00pm']), availability: 'on Thurs and Fri'},
//      {id: 'Peter', duration: 1, resources: (['7:15am to 5:00pm']), availability: 'before 10:00am'},
//      {id: 'Sam', duration: 2, resources: (['7:15am to 5:00pm'])},
//      {id: 'Alan', duration: 2, resources: (['E1'])},
//      {id: 'James', duration: 8, resources: (['E1'])},
//      {id: 'Steve', duration: 1, resources: (['E1']),  availability: 'after 12:00 and before 1:00pm'},
//      {id: 'Mark', duration: 2, resources: (['E1'])},
//      {id: 'Alex', duration: 8, resources: (['E1'])}
//    ];
//
//    // Step 2: Define our elevators (resources)
//    var resources = [
//      {id: 'Bob', availability: 'every day'},
//      {id: 'Jim', availability: 'before 06:00am'}
//    ];
//
//    //var tasks = reservations;
//
//    //var resources = elevators;
//
//    // Step 5: Pick a start date for the schedule and set correct timezone
//    var start = new Date(2013, 2, 21);
//    schedule.date.localTime();
//
//    // Step 6: Create the schedule
//    var s = schedule.create(tasks, resources, null, start);
//
//    for(var id in s.scheduledTasks) {
//      var st = s.scheduledTasks[id];
//      console.log(st);
//        var x;
//        var txt = "";
//        for (x in resources) {
//        txt += resources[x] + " ";
//        }
//        alert(txt);
//    
//        
//      document.write('<h2>' + id + '</h2>');
//      document.write('<p><b>Duration:</b> ' + st.duration + ' mins</p>');
//      document.write('<p><b>Start:</b> ' + new Date(st.earlyStart).toLocaleString() + '</p>');
//      document.write('<p><b>Finish:</b> ' + new Date(st.earlyFinish).toLocaleString() + '</p>');
//        
//    }
    
});    
