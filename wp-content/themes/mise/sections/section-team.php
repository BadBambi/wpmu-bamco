<?php $showTeam = mise_options('_onepage_section_team', ''); ?>
<?php if ($showTeam == 1) : ?>
	<?php
		$teamSectionID = mise_options('_onepage_id_team', 'team');
		$teamTitle = mise_options('_onepage_title_team', __('Our Team', 'mise'));
		$teamSubTitle = mise_options('_onepage_subtitle_team', __('Nice to meet you', 'mise'));
		$customMore = mise_options('_excerpt_more', '&hellip;');
		$textLenght = mise_options('_onepage_lenght_team', '50');
		$formattedOrPlain = mise_options('_onepage_typetext_team', 'formatted');
		$teamTestimonialBox = array();
		for( $number = 1; $number < MISE_VALUE_FOR_TEAM; $number++ ){
			$teamTestimonialBox["$number"] = mise_options('_onepage_choosepage_'.$number.'_team', '');
		}
	?>
<section class="mise_team" id="<?php echo esc_attr($teamSectionID); ?>">
	<div class="mise_team_color"></div>
	<div class="mise_action_team">
		<?php if($teamTitle || is_customize_preview()): ?>
			<h2 class="misee_main_text"><?php echo esc_html($teamTitle); ?></h2>
		<?php endif; ?>
		<?php if($teamSubTitle || is_customize_preview()): ?>
			<p class="mise_subtitle"><?php echo esc_html($teamSubTitle); ?></p>
		<?php endif; ?>
		<div class="team_columns">
			<?php for( $number = 1; $number < MISE_VALUE_FOR_TEAM; $number++ ) : ?>
				<?php if ($teamTestimonialBox["$number"]) : ?>
					<div class="miseTeamSingle">
						<?php if ('' != get_the_post_thumbnail($teamTestimonialBox["$number"])) : ?>
							<?php echo get_the_post_thumbnail(intval($teamTestimonialBox["$number"]), 'mise-little-post'); ?>
						<?php endif; ?>
						<div class="miseTeamName"><?php echo esc_html(get_the_title(intval($teamTestimonialBox["$number"]))); ?></div>
						<div class="miseTeamDesc">
						<?php 
							$post_contentt = get_post(intval($teamTestimonialBox["$number"]));
							$content = $post_contentt->post_content; ?>
							<?php if ($formattedOrPlain == 'formatted'): ?>
								<p><?php echo force_balance_tags( html_entity_decode( wp_trim_words( do_shortcode( htmlentities($content) ), intval($textLenght), esc_html($customMore) ) ) ); ?></p>
							<?php else: ?>
								<p><?php echo wp_trim_words($content , intval($textLenght), esc_html($customMore) ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endfor; ?>
		</div>
	</div>
</section>
<?php endif; ?>