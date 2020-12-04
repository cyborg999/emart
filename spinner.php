 <style type="text/css">
 	.preloader .btn {
 		display: block;
 		margin: 20% auto 0;
 	}
 </style>
 <div class="row  preloader hidden">
 	<div class="col-sm">
 		 <button class="btn btn-primary btn-lg" type="button" disabled>
		    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
		    Loading...
		  </button>
 	</div>
 </div>

 <script type="text/javascript">
 	function hidePreloader(){
 		setTimeout(function(){
			$(".preloader").addClass("hidden");
		}, 200);
 	}

 	function showPreloader(){
		$(".preloader").removeClass("hidden");
 	}
 </script>