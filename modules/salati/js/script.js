
function affsalat(lg,lt) { 

    var date = new Date(); // today
	var times = prayTimes.getTimes(date, [ lg, lt], +1);
	var list = ['Fajr', 'Dhuhr', 'Asr', 'Maghrib', 'Isha'];
	var n  = ['Fajr ', 'Dhohr ', 'Asr ', 'Maghrib ', 'Isha '];

	var html = '<ul id="timetable">';
	 html += '<li>Le '+ date.toLocaleDateString()+ '</li> ';
	for(var i in list)	{
		html += '<li>'+ n[i] + ':'+ times[list[i].toLowerCase()]+ '</li> ';
	}
	html += '</ul>';
	document.getElementById('table').innerHTML = html;

}
