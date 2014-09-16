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

	<div class="row-fluid price-row">
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
			<p class="price_pm">$20/month</p>
			<p class="price_feature">Up to 10 team members</p>
			<p class="price_feature">Up to 10 live projects</p>
			<p class="price_feature">Unlimited archiving</p>
		</aside>
		<aside class="price_block span3 center">
			<p class="price_band">Unlimited Teams</p>
			<p class="price_pm">$50/month</p>
			<p class="price_feature">Unlimited team members</p>
			<p class="price_feature">Unlimited live projects</p>
			<p class="price_feature">Unlimited archiving</p>
		</aside>
	</div>
	
</div>
<script type="text/javascript" src="js/login.js"></script> 
