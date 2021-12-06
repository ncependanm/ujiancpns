var ComingSoon = function () {

    return {
        //main function to initiate the module
        init: function () {

            $.backstretch([
		            "asset/img/bg/1.jpg",
		            "asset/img/bg/3.jpg"
		        ], {
		        fade: 1000,
		        duration: 10000
		   });
        }

    };

}();

jQuery(document).ready(function() {    
   ComingSoon.init(); 
});