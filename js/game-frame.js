parent.postMessage(window.location.toString(), "*");

var originalAlert = window.alert;
window.alert = function(s) {
	parent.postMessage("success", "*");
	setTimeout(function() { 
	// originalAlert(s);
	// }, 50);
}
