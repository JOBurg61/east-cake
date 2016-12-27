
var job_drop;
var job_drops = new Map();		
		
function getUserDrop(obj){
	return "DROPDOWN";
}

gantt.config.scale_unit="hour";
gantt.config.duration_unit = "minute";
gantt.config.duration_step = 15; 
gantt.config.round_dnd_dates = false;
gantt.config.time_step = 15;
gantt.config.start_date = new Date(2017, 01, 20, 13, 00);
gantt.config.end_date = new Date(2017, 01, 27);
gantt.config.date_scale = "%D - %H:%i";

gantt.config.columns = [
	{name:"role-button", label:"Jobs",	width:"*", template: function(obj){ return '<select id=T' + obj.id + '></select>'} },
	//{name:"volunteer-button", label:"Volunteer", width:"*", template: function(obj){ return getUserDrop(obj) }},
	{name:"text",       label:"Assigned",  width:"*", tree:true },
	{name:"add",        label:"",   width:44}
];

gantt.attachEvent("onAfterTaskAdd", function(tid,item){
	
	$.getJSON("http://localhost/east/jobs/")
		.done(
			
			function (data){
				//console.log(data.jobs)
				for (var i = 0; i < data.jobs.length; i++) {
					console.log("<option value='" + data.jobs[i].id + "'>" + data.jobs[i].description + "</option>");
					$("#T" + tid).append("<option value='" + data.jobs[i].id + "'>" + data.jobs[i].description + "</option>");
				}	
			}
		);
});

gantt.init("gantt_here");

