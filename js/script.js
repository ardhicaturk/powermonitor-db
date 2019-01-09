var host = "http://127.0.0.1:8099";
var title = ["PLN", "Genset", "Wind Turbine","Panel Surya"];
var beban = ["Rumahan", "Legal", "Ilegal"];
var powerState=[0,0,0,0];
var loadState=[0,0,0];
function getData(){
	$.ajax({
		url:host+"/read",
		dataType: "text",
		async:true,
		success: function(result){
			var buf = $.parseJSON(result);
			//alert(buf.tegangan);
			for(var i = 0; i< 4;i++){
				$("#tgvalpower"+String(i)).html(String(buf.tegangan[i].toFixed(2)) + "V");
				$("#arvalpower"+String(i)).html(String(buf.arus[i].toFixed(2)) + "A");
				var zxc = buf.tegangan[i]*buf.arus[i];
				$("#pwrvalpower"+String(i)).html(String(zxc.toFixed(2)) + "W");
			}
			for(var i = 0; i< 3;i++){
				$("#tgvalload"+String(i)).html(String(buf.tegangan[i+4].toFixed(2)) + "V");
				$("#arvalload"+String(i)).html(String(buf.arus[i+4].toFixed(2)) + "A");
				var zxc = buf.tegangan[i+4]*buf.arus[i+4];
				$("#pwrvalload"+String(i)).html(String(zxc.toFixed(2)) + "W");
			}
		},
		complete: function (){
			setTimeout(getData,2000);
		}
	});
}
console.log = function(message) {$('#debugDiv').append('<p style=\'font-style: italic;\'>new message:</p><p>' + message + '</p>');
$('#debugDiv').scrollTop(1000000);
};
console.error = console.debug = console.info =  console.log;

function elmntgrid(i, a, t){
	var elementGrid="";
	var z = t == 'power' ? powerState[i] : loadState[i];
	var v = z > 0 ? "ON" : "OFF";
	var x = z > 0 ? "checked" : "";
    elementGrid += "<div class=\"mon1\"><h2 class=\"title\">"+a+"</h2>";
    elementGrid += "<div class=\"col22\">";
    elementGrid += "<div class=\"col221\">";
    elementGrid += "<table><tr><td>Voltage</td><td>:</td><td id='tgval"+t+i+"'>220V</td></tr><tr><td>Arus</td><td>:</td><td id='arval"+t+i+"'>1A</td></tr><tr><td>Daya</td><td>:</td><td id='pwrval"+t+i+"'>440W</td></tr></table>";
    elementGrid += "</div><div class=\"col222\">";
    elementGrid += "<h3>Status</h3>";
    elementGrid += "<div class='status-power'><div class='powercol1'><label class=\"switch\">";
    elementGrid += "<input id='instatus"+t+i+"' type=\"checkbox\" "+x+">";
    elementGrid += "<span class=\"slider round\"></span></label></div><div class='powercol2' id='status"+t+i+"'>"+v+"</div></div>";
	elementGrid += "</div></div></div>";

    return elementGrid;
}
function sst(a, z){
	$('#instatus'+z+a).change(function(){
		if($('#instatus'+z+a).prop('checked')){
			$('#status'+z+a).html('ON');
			if(z == 'power'){
				powerState[a] = 1;
			} else {
				loadState[a] = 1;
			}
		} else {
			$('#status'+z+a).html('OFF');
			if(z == 'power'){
				powerState[a] = 0;
			} else {
				loadState[a] = 0;
			}
		}
		$.get(host+"/dio?s1=" + powerState[0] + "&s2=" + powerState[1] + "&s3=" + powerState[2] + "&s4=" +powerState[3]+ "&b1=" + loadState[0] + "&b2=" + loadState[1] + "&b3=" + loadState[2], function(data, status){
			console.log("DIO: "+status);
		});
	});
}
function getState(){
	var strSplit;
	$.get(host+"/data", function(data, status){
		strsSplit = data.split(",");
		for(var i = 0; i< 4;i++){
			if(strsSplit[i] == 0){
				powerState[i] = 0;
				$("#instatuspower"+String(i)).prop('checked',false);
				$('#statuspower'+String(i)).html('OFF');
			} else{
				powerState[i] = 1;
				$("#instatuspower"+String(i)).prop('checked',true);
				$('#statuspower'+String(i)).html('ON');
			}
		}
		for(var i = 0; i< 3;i++){
			if(strsSplit[i+4] == 0){
				loadState[i] = 0;
				$("#instatusload"+String(i)).prop('checked',false);
				$('#statusload'+String(i)).html('OFF');
			} else{
				loadState[i] = 1;
				$("#instatusload"+String(i)).prop('checked',true);
				$('#statusload'+String(i)).html('ON');
			}
		}
		
		setTimeout(getState,1000);
	});
}
$(document).ready(function(){
    for(var a = 0; a<4; a++){
		$(".grid-mon").append(elmntgrid(a, title[a],'power'));
		sst(a, 'power');
    }
    for(var a = 0; a<3; a++){
		$(".grid-mon2").append(elmntgrid(a, beban[a],'load'));
		sst(a, 'load');
    }
    getState();
	getData();
});