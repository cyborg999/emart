 <style type="text/css">
 	.preloader {
		content: "";
		width: 100%;
		height: 100vh;
		position: fixed;
		left: 0;
		top: 0;
		background: rgba(255,255,255,.5);
		z-index: 2000;
	}
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