<div class="navbar">
    <div class="navbar-inner"> <a class="mainbrand brand" href="/"><span class='brandcol1'>agend</span><span class='brandcol2'>r</span></a>
    <ul class="nav">
      <li id="nav_dashboard"><a href="/dashboard">Live Projects</a></li>
      <li id="nav_archive"><a href="/archive">Archive</a></li>
      <li id="nav_profile"><a href="/profile">My Profile</a></li>
      <li id="nav_upgrade"><a href="/upgrade">Upgrade</a></li>
    </ul>
      <ul class="nav pull-right">
        <li ><a href="https://agendr.uservoice.com/" target="_blank">Feedback</a></li>
      </ul>    
  </div>
</div>
<script>	
	$(document).ready(function(){
		activeNav("<?php echo($_SESSION['pageid']) ?>");
	});

</script>