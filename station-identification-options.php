<style type="text/css">
/* CSS3 Gradient Buttons 
Thanks to http://www.webdesignerwall.com/tutorials/css3-gradient-buttons/
---------------------------------------------- */
.cssbutton {
	display: inline-block;
	zoom: 1; /* zoom and *display = ie7 hack for display:inline-block */
	*display: inline;
	vertical-align: baseline;
	margin: 0 2px;
	outline: none;
	cursor: pointer;
	text-align: center;
	text-decoration: none;
	padding: .5em 2em .55em;
	text-shadow: 0 1px 1px rgba(0,0,0,.3);
	-webkit-border-radius: .5em; 
	-moz-border-radius: .5em;
	border-radius: .5em;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	box-shadow: 0 1px 2px rgba(0,0,0,.2);
}

.cssbutton:hover {
	text-decoration: none;
}

.cssbutton:active {
	position: relative;
	top: 1px;
}


.bigrounded {
	-webkit-border-radius: 2em;
	-moz-border-radius: 2em;
	border-radius: 2em;
}
.medium {
	font-size: 12px;
	padding: .4em 1.5em .42em;
}
.small {
	font-size: 11px;
	padding: .2em 1em .275em;
}


/* blue */
.blue {
	color: #fff;
	border: solid 1px #0076a3;
	background: #0095cd;
	background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
	background: -moz-linear-gradient(top,  #00adee,  #0078a5);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
}
.blue:hover {
	background: #007ead;
	background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
	background: -moz-linear-gradient(top,  #0095cc,  #00678e);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0095cc', endColorstr='#00678e');
	color: white;
}
.blue:active {
	color: #80bed6;
	background: -webkit-gradient(linear, left top, left bottom, from(#0078a5), to(#00adee));
	background: -moz-linear-gradient(top,  #0078a5,  #00adee);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0078a5', endColorstr='#00adee');
}

#station-identification-wrapper {
	width: 600px;
	border: 1px solid #ddd;
	margin: 10px 0 0 0;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	background: #fff;
	background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#fafafa));
	background: -moz-linear-gradient(top,  #fff,  #ededed);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed');
}

#station-identification-wrapper label {
	margin: 10px 0 10px 10px;
	clear: both;
	width: 580px;
	float: left;
}

.clarification {

	color: #666;
	margin-left: 10px;
}

textarea {
	width: 580px;
	margin: 0 0 10px 10px;

}

.exfu-section-header {
	background: #eee;
	font-weight: normal;
	text-shadow: -1px 1px 1px #fff;
	-webkit-border-top-left-radius: 3px;
	-webkit-border-top-right-radius: 3px;
	-moz-border-radius-topleft: 3px;
	-moz-border-radius-topright: 3px;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	width: 590px;
	height: 30px;
	margin: 5px;
}

.exfu-section-header h3 {
	float: left;
	margin: 0;
	padding: 5px;
}

.cssbutton {
	float: right;
	clear: both;
	margin: 10px 10px 10px 0;
}

p {
	margin: 0 10px 0 10px;
}

#station-identification-preview {
	clear: both;
	width: 580px;
	margin: 20px 0 10px 10px;
}

.upgrade-now {
	float: right;
	margin-top: 7px;
}

.upgrade-now a {
	color: #000;
}

</style>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function($) {
	stationIdentUpdatePreview();

	$('#station_identification_message').keyup(function(){
		stationIdentUpdatePreview();
	});
	
	function stationIdentUpdatePreview()
	{
		var message = $('#station_identification_message').val();
		
		var message = message.replace(/%%author%%/g,'<a href="#">Author Name</a>');
		var message = message.replace(/%%post_title%%/g,'<a href="#">The Post Title</a>');
		var message = message.replace(/%%blog_name%%/g,'<a href="#"><?php bloginfo('name'); ?></a>');
		
		$('#station-identification-preview-output').html(message);
	}
});
//]]>
</script>
<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Station Identification Settings</h2>
<div id="station-identification-wrapper">
	<div class="exfu-section-header">
		<h3>Your Station Ident Message</h3>
		<div class="upgrade-now">
			<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=99JSKLMNVPWAU">License Station Identification ($2)</a>  | <a href="http://getsatisfaction.com/extrafuture/products/extrafuture_station_identification">Help & Support</a></p>
		</div>
	</div>
	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
		<label for="station_identification_message">Your Message: </label>
		
		<textarea name="station_identification_message" rows="5" cols="60" id="station_identification_message" type="text"><?php echo get_option('station_identification_message'); ?></textarea>
		<p class="clarification"><strong>Variables:</strong> %%author%% - author name &bull; %%post_title%% - post title and link &bull; %%blog_name%% - the name and link of this blog</p>
			
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="station_identification_message" />
		
		<button class="cssbutton blue">Save Changes</button>
	</form>
	
	<div id="station-identification-preview">
	<h3>Your Station Ident Will Look Like</h3>
	<hr>
	<p id="station-identification-preview-output"></p>
	</div>
</div>
</div>