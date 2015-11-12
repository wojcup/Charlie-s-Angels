<h3><?php esc_attr_e( '2 Columns Layout: relative (%)', 'wp_admin_style' ); ?></h3>

<div class="wrap">

	<h2><?php esc_attr_e( 'The Official WordPress Tree House Bdge Plugin', 'wp_admin_style' ); ?></h2>
	<div id="col-container">

		<div id="col-right">
		<?php echo 'username::'.$wptreehouse_username; ?>
			<?php if(!isset($wptreehouse_username)||$wptreehouse_username==''){ ?>
			<div class="col-wrap">
				<?php esc_attr_e( 'Let\'s start here', 'wp_admin_style' ); ?>
				<div class="inside">
					<p><strong>Table with class <code>widefat</code></strong></p>
					<form name="wptreehouse_username_form" action="" method="post">
					<input type="hidden" name="wptreehouse_form_submitted" value="Y">
					<table class="widefat">
						<tr>
							<td class="row-title"><label for="wptreehouse_username"><?php esc_attr_e(
										'Treehouse username', 'wp_admin_style'
									); ?></label></td>
							<td><input  name="wptreehouse_username" id="wptreehouse_username" type="text" value="" class="regular-text" /></td>
							
						</tr>
					</table>
					<p>
					<input class="button-primary" type="submit" name="wptreehouse_username_submit" value="save" />
					</p>
					</form>
				</div>

			</div>
			<?php } else { ?>
			<!-- /col-wrap -->

			<?php if($display_json==true){ ?>
			
			<div class="col-wrap">
				<?php esc_attr_e( 'JSON - Feed', 'wp_admin_style' ); ?>
				<div class="inside">
					<p><strong>Below are your 20 most recent badges</strong></p>
					<ul class="wptreehouse-badges">
					<?php for( $i=0;$i<20; $i++){ ?>
					<li>
						<ul>
							<li>
								<img width="120" src="<?php echo $wptreehouse_profile->{'badges'}[$i]->{'icon_url'}; ?>" />
							</li>
							
							<?php if($wptreehouse_profile->{'badges'}[$i]->{'url'} != $wptreehouse_profile->{'profile_url'}){ ?>
								<li class="wptreehouse-badge-name">
									<a href="<?php echo $wptreehouse_profile->{'badges'}[$i]->{'url'}; ?>">
										<?php echo $wptreehouse_profile->{'badges'}[$i]->{'name'}; ?></a>
								</li>
								<li class="wptreehouse-project-name">
									<a href="<?php echo $wptreehouse_profile->{'badges'}[1]->{'courses'}[0]->{'url'}; ?>"><?php echo $wptreehouse_profile->{'badges'}[1]->{'courses'}[0]->{'title'}; ?></a>
								</li>
							<?php } else { ?>
									<li class="wptreehouse-badge-name">
									<?php echo $wptreehouse_profile->{'badges'}[$i]->{'name'}; ?>
									</li>
							
							<?php } ?>
						</ul>
					</li>
						
					<?php } ?>
					</ul>

				</div>

			</div>
							<?php } ?>
			<!-- /col-wrap -->

				<div class="col-wrap">
					<?php esc_attr_e( 'JSON Feed', 'wp_admin_style' ); ?>
					<div class="inside">
						<p><?php echo $wptreehouse_profile->{'name'}; ?></p>
						<p><?php echo $wptreehouse_profile->{'profile_url'}; ?></p>
						<p><?php echo $wptreehouse_profile->{'badges'}[1]->{'courses'}[1]->{'title'}; ?></p>
							<p><?php ?></p>
										
						<pre><code>
							<?php var_dump( $wptreehouse_profile ); ?>
						</code></pre>
							
							
				
					</div>
				</div>

			
			<?php } ?>
			
		</div>
		<!-- /col-right -->
		<?php if(isset($wptreehouse_username)&&$wptreehouse_username!=''){ ?>
		<div id="col-left">

			<div class="col-wrap">
				<?php echo $wptreehouse_profile->{'name'}.'\'s Profile'; ?>
				<div class="inside">
					<p><img width="100%" class="wptreehouse-gravatar" src="<?php echo $wptreehouse_profile->{'gravatar_url'}; ?>" alt="Mike the Frog Gravatar" /></p>
					<ul class="wptreehouse-badges-and-points">
						<li> Badges: <strong><?php echo count ($wptreehouse_profile->{'badges'}); ?></strong></li>
						<li> Points: <strong><?php echo $wptreehouse_profile->{'points'}->{'total'}; ?></strong></li>
					</ul>
					
					<form name="wptreehouse_username_form" action="" method="post">
					<input type="hidden" name="wptreehouse_form_submitted" value="Y">
					<p>
						<label for="wptreehouse_username"><?php esc_attr_e('Username', 'wp_admin_style'); ?></label></p>
					<p>
						<input  name="wptreehouse_username" id="wptreehouse_username" type="text" value="<?php echo $wptreehouse_username; ?>" /></p>
					<p>
						<input class="button-primary" type="submit" name="wptreehouse_username_submit" value="Update" /></p>
					</form>
					
					
				</div> <!-- inside -->

			</div>
			<!-- /col-wrap -->

		</div>
		
		<?php } ?>
		<!-- /col-left -->

	</div>
	<!-- /col-container -->

</div> <!-- .wrap -->
