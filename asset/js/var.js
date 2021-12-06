$(document).ready(function(){ 
	hideLoading();
});

function showLoading() {
    $("#loading").fadeIn(600);
}
function hideLoading() {
    $("#loading").fadeOut(300);
}