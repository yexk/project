<!-- BEGIN JS -->
<script src="js/jquery-1.8.3.min.js" ></script><!-- BASIC JQUERY 1.8.3 LIB. JS -->
<script src="js/bootstrap.min.js" ></script><!-- BOOTSTRAP JS -->
<script src="js/jquery.dcjqaccordion.2.7.js"></script><!-- ACCORDIN JS -->
<script src="js/jquery.scrollTo.min.js" ></script><!-- SCROLLTO JS -->
<script src="js/jquery.nicescroll.js" ></script><!-- NICESCROLL JS -->
<script src="js/respond.min.js" ></script><!-- RESPOND JS -->
<script src="js/jquery.sparkline.js"></script><!-- SPARKLINE JS -->
<script src="js/sparkline-chart.js"></script><!-- SPARKLINE CHART JS -->
<script src="js/common-scripts.js"></script><!-- BASIC COMMON JS -->
<script src="js/count.js"></script><!-- COUNT JS -->
<!-- END JS -->
<script>
Config = {};

$(function(){
	Config._token = $('meta[name="_token"]').attr('content');


	$(".go-top").click(function(){ 
        $.scrollTo(0,1000); 
    });
    
	var url_pathname = location.pathname;
	$("#nav-accordion li a").each(function(index, el) {

		if (-1 != el.href.indexOf(url_pathname) ) {
			$activeLi  = $(this).parent('li');
			$parentsUl = $activeLi.parent('ul');
			$parentsA  = $parentsUl.siblings('a');
			if ('nav-accordion' == $parentsUl.attr('ID')) {
				// 一级菜单
				$(this).addClass('active');
			}else{
				$activeLi.addClass('active');
				$parentsUl.show();
				$parentsA.addClass('active');
			}
		}
	});
});
</script>