			<div class="footer">
				<?php
					$footerLogo = get_field('footer_logo', 'options');
					$footerNav = get_field('footer_navigation', 'options');
					$footerSocial = get_field('footer_social', 'options');
					$footerCta = get_field('footer_cta', 'options');
					$footerAddress = get_field('footer_address', 'options');
					if($footerLogo || $footerNav || $footerSocial) {
						echo '<nav class="footerNav">';
							if($footerLogo) { echo '<a class="navitem space">' . wp_get_attachment_image($footerLogo['id'], 'medium') . '</a>'; }
							if($footerNav) {
								foreach($footerNav as $nav) {
									$name = $nav['name'];
									echo '<a class="navitem">' . $name . '</a>';
								}
							}
							if($footerSocial) {
								echo '<div class="socialIcons">';
									foreach($footerSocial as $social) {
										$icon = $social['icon'];
										$link = $social['link'];
										if($link['url']) { echo '<a href="' . $link['url'] . '" class="navitem inline" target="' . $link['target'] . '">'; }
											if($icon) { echo wp_get_attachment_image($icon['id'], 'small', false, array('class' => 'icon')); }
										if($link['url']) { echo '</a>'; }
									}
								echo '</div>';
							}
						echo '</nav>';
					}
					if($footerCta || $footerAddress) {
						echo '<div class="callToAction">';
							$ctaHeading = $footerCta['heading'];
							$ctaButton = $footerCta['button'];
							$ctaContent = $footerCta['content'];
							if($ctaHeading) { echo '<h3>' . $ctaHeading . '</h3>'; }
							if($ctaContent) { echo '<p class="joinWaitlist">' . $ctaContent . '</p>'; }
							if($ctaButton) {
								echo '<div class="buttonWrap small">';
									echo '<button>' .$ctaButton . '</button>';
									echo '<div class="inputWrap"><label class="inputLabel" for="enterPhoneTwo">enter your phone number</label><input id="enterPhoneTwo" class="fieldInput enterPhone" type="tel" /></div>';
								echo '</div>';
							}
							if($footerAddress) { echo '<p class="address">' . $footerAddress . '</p>'; }
						echo '</div>';
					}
				?>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>
