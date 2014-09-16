<style>
@media all and (min-width: 320px) and (max-width: 980px) {
	.hero-unit{background-position: left;}
};
@media all and (min-width: 980px) { 
	.hero-unit{background-position: right;}
};


</style>
<div class="container-fluid">
<? include("views/loggedin.nav.frag.php"); ?>

	<div class="row-fluid">
		<aside class="span12 center">	
			<h1>Pick a package</h1>
		</aside>
	</div>
</div>
<div class="container-fluid">	
	<div id="price_row" class="row-fluid price_row">
		<aside class="price_block span3 center">
			<p class="price_band">Freelancer</p>
			<p class="price_pm">$0/month</p>
			<p class="price_feature">Free for up to 10 live projects</p>
			<p class="price_feature">Unlimited archiving</p>

		</aside>
		<aside class="price_block span3 center">
			<p class="price_band">Unlimited Freelancer</p>
			<p class="price_pm">$5/month</p>
			<p class="price_feature">Unlimited live projects</p>
			<p class="price_feature">Unlimited archiving</p>
		</aside>
		<aside class="price_block span3 center">
			<p class="price_band">Starter Teams</p>
			<p class="price_pm">$10/month</p>
			<p class="price_feature">Up to 10 team members</p>
			<p class="price_feature">Up to 10 live projects</p>
			<p class="price_feature">Unlimited archiving</p>
		</aside>
		<aside class="price_block span3 center">
			<p class="price_band">Unlimited Teams</p>
			<p class="price_pm">$25/month</p>
			<p class="price_feature">Unlimited team members</p>
			<p class="price_feature">Unlimited live projects</p>
			<p class="price_feature">Unlimited archiving</p>
		</aside>
	</div>
	<div id="price_row" class="row-fluid" style="margin-top: 2em;">
		<aside class="span3 center">
			<p><a href="#" class="btn btn-large btn-info">You're already on this package</a></p>
		</aside>
		<aside class="span3 center">
			<p><a href="#" class="btn btn-large btn-success">Coming Soon</a></p>
		</aside>
		<aside class="span3 center">
			<p><a href="#" class="btn btn-large btn-success">Coming Soon</a></p>
		</aside>
		<aside class="span3 center">
			<p><a href="#" class="btn btn-large btn-success">Coming Soon</a></p>
		</aside>
	</div>
</div>
<script>
	//alert($('#price_row').height())
	$('.price_block').height($('#price_row').height());

</script>
