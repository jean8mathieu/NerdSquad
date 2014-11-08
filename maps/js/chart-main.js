(function(){
var t;
function size(animate){
	if (animate == undefined){
		animate = false;
	}
	clearTimeout(t);
	t = setTimeout(function(){
		$("canvas").each(function(i,el){
			$(el).attr({
				"width":$(el).parent().width(),
				"height":$(el).parent().outerHeight()
			});
		});
		redraw(animate);
		var m = 0;
		$(".widget").height("");
		$(".widget").each(function(i,el){ m = Math.max(m,$(el).height()); });
		$(".widget").height(m);
	}, 30);
}
$(window).on('resize', function(){ size(false); });


function redraw(animation){
	var options = {};
	if (!animation){
		options.animation = false;
	} else {
		options.animation = true;
	}
	var data = [
		{
			value: 20,
			color:"#1ABC9C"
		},
		{
			value : 30,
			color : "#E52C39"
		},
		{
			value : 10,
			color : "#EAC80D"
		}

	];
	var canvas = document.getElementById("hours");
	var ctx = canvas.getContext("2d");
	new Chart(ctx).Doughnut(data, options);

	var data = {
		labels : ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],
		datasets : [
			{
				fillColor : "#E52C39",
				strokeColor : "#9095AA",
				pointColor : "#9095AA",
				pointStrokeColor : "#fff",
				data : [65,54,30,81,56,55,40]
			},
			{
				fillColor : "#1ABC9C",
				strokeColor : "#9095AA",
				pointColor : "#9095AA",
				pointStrokeColor : "#fff",
				data : [20,60,42,58,31,21,50]
			},
		]
	}
	var canvas = document.getElementById("shipments");
	var ctx = canvas.getContext("2d");
	new Chart(ctx).Line(data, options);



	var data = {
		labels : ["Helpful","Friendly","Kind","Rude","Slow","Frustrating"],
		datasets : [
			{
				fillColor : "#9095AA",
				strokeColor : "#9095AA",
				pointColor : "#9095AA",
				pointStrokeColor : "#9095AA",
				data : [65,59,90,81,30,56]
			}
		]
	}
	var canvas = document.getElementById("departments");
	var ctx = canvas.getContext("2d");
	new Chart(ctx).Radar(data, options);
}
size(true);

}());