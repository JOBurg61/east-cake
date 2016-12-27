var controller;
var entity_id;
dateFormat.masks.scheduleFormat = "yyyy-mm-dd HH:MMo"; // For consumption by postgres
dateFormat.masks.displayFormat = "dd-mm-yyyy HH:MM"; // For consumption by the scheduler API

$(document).ready(function () {
	$(document)
	.ajaxStart(function () {
	   $("#ajaxSpinnerImage").show();
	})
	.ajaxStop(function () {
	   $("#ajaxSpinnerImage").hide();
	});

	$.getJSON("/east/users/applicants", 
		function(data) { 
				for (var i = 0; i < data.users.length; i++) {
					$("#volunteer-select").append("<option value='" + data.users[i].id + "'>" + data.users[i].full_name + "</option>");
				}			
		}
	);
	
	$.getJSON("/east/jobs", 
		function(data) { 
				for (var i = 0; i < data.jobs.length; i++) {
					$("#task-select").append("<option value='" + data.jobs[i].id + "'>" + data.jobs[i].description + "</option>");
				}			
		}
	);
	
	var _t = window.location.pathname.split('/');
	entity_id = _t[_t.length - 1];
	controller = _t[_t.length - 3];
	
	$.getJSON("http://localhost/east/venue-schedules/index/" + entity_id, 
		function(data) { 
			for (var i = 0; i < data.venueSchedules.length; i++) {
				var record = {};
			
				record.id = data.venueSchedules[i].id;
				record.start_date = formatDate(new Date(data.venueSchedules[i].start_date), "ui");
				record.end_date = formatDate(new Date(data.venueSchedules[i].end_date), "ui");
				record.text = '<b>' + data.venueSchedules[i].volunteer_name + ':</b><p> ' + data.venueSchedules[i].job;	
				record.venue_id = data.venueSchedules[i].venue_id;
				record.job_id = data.venueSchedules[i].job_id;
				record.source = 'db';
				scheduler.addEvent(record);
				console.log(record);
			}			
		}
	);	
 });

scheduler.config.icons_select = [
   "icon_details",
   "icon_delete"
];

scheduler.locale.labels.icon_volunteer = "Select a Volunteer";
scheduler.config.dblclick_create = true;
scheduler.config.edit_on_create = true;
scheduler.config.details_on_create = true;
scheduler.config.details_on_dblclick = false;
scheduler.config.first_hour = 7;
scheduler.config.last_hour = 23;
scheduler.config.default_date = "%D, %F %j";
scheduler.config.day_date = "%D, %F %j";
scheduler.config.time_step = 15;

scheduler.config.lightbox.sections = [
    { name: "Task", height: 40, type:"template", map_to:"task_list"},
    { name: "Assigned To", height: 40, type:"template", map_to:"volunteer_list"},
    { name:"Time", height:72, type:"time", map_to:"auto"}
];

scheduler._click.buttons.volunteer = function(id){
   console.log("Volunteer button clicked on event id " + id);
};

/* 
* Format the the event marker.
*/
function updateEvent(e){
	
	if(e.source == 'db'){
		return ev;
	}
	
	var _eval = $("#TSL" + e.id).val();
	var jerb = $("#TSL" + e.id + " " + "option:selected").text();
	var jerber = $("#VSL" + e.id + " " + "option:selected").text();
	e.job_name = "<b>" + jerb + "</b> ";
	e.job_val = $("#TSL" + e.id).val();
	e.vol_val = $("#VSL" + e.id).val();
	e.text =  "<b>" + jerber + ":</b> " + jerb;
}

function formatDate(d, format){
//dateFormat.masks.scheduleFormat = "yyyy-mm-dd HH:MM"; // For consumption by postgres
//dateFormat.masks.displayFormat = "dd-mm-yyyy HH:MM"; // For consumption by the scheduler API
	var dateString;
	var m = d.getMonth() + 1;
	var month = m < 10 ? '0' + m : m;
	var date = d.getDate() < 10 ? '0' + d.getDate() : d.getDate();
	var min = d.getMinutes() < 10 ? '0' + d.getMinutes() : d.getMinutes();
	var hr = d.getHours() < 10 ? '0' + d.getHours() : d.getHours();
	
	switch(format){
		case "db":
			dateString = d.getFullYear() + '-' + month + '-' + date + ' ' + hr + ':' + min;
		break;
		
		case "ui":
			dateString = date + '-' + month + '-' + d.getFullYear() + ' ' + hr + ':' + min;
		break;
	}
	
	//console.log("Formatted Date: " + dateString);
	return dateString;
}

function getRequestData(e){
	var request = {};
	request.id = e.id;
	request.job_id = e.job_val;
	request.user_id = e.vol_val;
	request.venue_id = entity_id;
	console.log(e.start_date);
	request.start_date = dateFormat(new Date(e.start_date), "scheduleFormat");
	console.log(request.start_date);
	request.end_date = dateFormat(new Date(e.end_date), "scheduleFormat");
	return request;
}

/**
* Attach the dropdowns and appropriate 
* object IDs to the event.
*/
scheduler.attachEvent("onEventCreated", function(id, e) {
    console.log("Created Event " + id);
	var ev = scheduler.getEvent(id);
	var d = $("#volunteer-select").clone();
	d.attr("id", "VSL" + id);
	ev.volunteer_list = d.prop('outerHTML');
	
	var _t = $("#task-select").clone();
    _t.attr("id", "TSL" + id);
	ev.task_list = _t.prop('outerHTML');
	ev.is_new = true;

	//scheduler.showLightbox(id);
});
 
scheduler.attachEvent("onEventAdded", function(id,e){
	console.log("Added Event " + id);
	//console.log(e);
	
	if(e.source == 'db'){ 
		return true; 
	}
	
	updateEvent(e);

	var r = getRequestData(e);

	$.post( "/east/schedules/add", 
			r, 
			function(data){
				//console.log(data)
			} ,
			'json'
	);
});

scheduler.attachEvent("onEventChanged", function(id,ev){
    console.log("Changed Event " + id);
	var e = scheduler.getEvent(id);
	if(e.source == 'db'){ return true }
	
	updateEvent(e);

	var r = getRequestData(e);

	$.post( "/east/schedules/edit/" + r.id, r, function(data){console.log(data)} ,'json');
});

scheduler.init('scheduler_here', new Date(2017, 01, 20, 13, 00),"week");
