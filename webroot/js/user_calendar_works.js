var controller;
var entity_id;
dateFormat.masks.scheduleFormat = "yyyy-mm-dd HH:MMo"; // For consumption by postgres
dateFormat.masks.displayFormat = "dd-mm-yyyy HH:MM"; // For consumption by the scheduler API

$(document).ready(function () {
	$(document)
	.ajaxStart(function () {
		scheduler.config.readonly = true;
		$("#ajaxSpinnerImage").show();
	})
	.ajaxStop(function () {
		scheduler.config.readonly = false;
		$("#ajaxSpinnerImage").hide();
	});

	$.getJSON("/east/venues/", 
		function(data) { 
				for (var i = 0; i < data.venues.length; i++) {
					$("#venue-select").append("<option value='" + data.venues[i].id + "'>" + data.venues[i].description + "</option>");
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
	
	$.getJSON("/east/user-schedules/index/" + entity_id, 
		function(data) { 
			for (var i = 0; i < data.userSchedules.length; i++) {
				var record = {};
			
				record.id = data.userSchedules[i].id;
				record.start_date = formatDate(new Date(data.userSchedules[i].start_date), "ui");
				record.end_date = formatDate(new Date(data.userSchedules[i].end_date), "ui");
				//record.text = '<b>' + data.userSchedules[i].job + ':</b><p> ' + data.userSchedules[i].venue;	
				var href = '/east/venues/calendar/' + data.userSchedules[i].venue_id;
				record.text = data.userSchedules[i].job;
				record.text += '<br><a class="event-link" href="' + href + '">' + data.userSchedules[i].venue + '</a>';
				
				record.venue_id = data.userSchedules[i].venue_id;
				record.job_id = data.userSchedules[i].job_id;
				record.color = data.userSchedules[i].type == "final" ? 'green' : 'red';
				record.type = data.userSchedules[i].type;
				record.source = 'db';
				scheduler.addEvent(record);
				//console.log(record);
			}			
		}
	);	
 });

scheduler.config.icons_select = [
   "icon_delete",
   "icon_save"
];

scheduler.locale.labels.icon_save = "Confirm Schedule Event."
scheduler.config.dblclick_create = true;
scheduler.config.edit_on_create = true;
scheduler.config.details_on_create = true;
scheduler.config.details_on_dblclick = false;
scheduler.config.first_hour = 7;
//scheduler.config.last_hour = 23;
scheduler.config.default_date = "%D, %F %j";
scheduler.config.day_date = "%D, %F %j";
scheduler.config.time_step = 15;

scheduler._click.buttons.save = function(id){
   alert("confirming " + id);
};

scheduler.config.lightbox.sections = [
    { name: "Task", height: 40, type:"template", map_to:"task_list"},
    { name: "Where at?", height: 40, type:"template", map_to:"venue_list"},
    { name:"Time", height:72, type:"time", map_to:"auto"}
];

function readonly_check(ev){
	return ev.type !== "final";
}

/* 
* Format the the event marker.
*/
function updateEvent(e){
	
	var _eval = $("#TSL" + e.id).val();
	var jerb = $("#TSL" + e.id + " " + "option:selected").text();
	var jerber = $("#VSL" + e.id + " " + "option:selected").text();
	e.job_name = "<b>" + jerb + "</b> ";
	e.job_val = $("#TSL" + e.id).val();
	e.vol_val = $("#VSL" + e.id).val();
	e.text =  "<b>" + jerber + ":</b> " + jerb;
}

function formatDate(d, format){

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

	return dateString;
}

function getRequestData(e){
	var request = {};
	request.id = e.id;
	request.job_id = e.job_val;
	request.user_id = entity_id;
	request.venue_id = e.vol_val;
	request.start_date = dateFormat(new Date(e.start_date), "scheduleFormat");
	request.end_date = dateFormat(new Date(e.end_date), "scheduleFormat");
	return request;
}

/**
* Attach the dropdowns and appropriate 
* object IDs to the event.
*/
scheduler.attachEvent("onEventCreated", function(id, ev) {
    // console.log("Created Event " + id);
	var e = scheduler.getEvent(id);
	var d = $("#venue-select").clone();
	d.attr("id", "VSL" + id);
	e.venue_list = d.prop('outerHTML');
	
	var _t = $("#task-select").clone();
    _t.attr("id", "TSL" + id);
	e.task_list = _t.prop('outerHTML');
	e.is_new = true;
});
 
scheduler.attachEvent("onEventAdded", function(id,e){
	//console.log("Added Event " + id);
	
	// We only care if the event was added via the UI
	// Ignore it if it was added from the DB.
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

scheduler.attachEvent("onEventChanged", function(id,e){
    //console.log("Changed Event " + id);
	var r = getRequestData(e);

	$.post( "/east/schedules/edit/" + r.id, 
			r, 
			function(data){
				//console.log(data)
			} 
			,
			'json');
});

scheduler.attachEvent("onBeforeEventChanged", readonly_check);
scheduler.init('scheduler_here', new Date(2017, 01, 20, 13, 00),"week");
