<?php
	/* TEMPLATE NAME: Landing Page */
	get_header();
		if(have_posts()) { while(have_posts()) { the_post();

      // SECTION: Home
      $homeLogo = get_field('home_logo');
      $homeText = get_field('home_text');
      $homeImage = get_field('home_image');
      if($homeLogo || $homeText || $homeImage) {
        echo '<div class="contentBlock home">';
          if($homeLogo) { echo wp_get_attachment_image($homeLogo['id'], 'large', false, array('class' => 'copperCLogo')); }
          if($homeText) {
            echo '<div class="homeText">';
              if($homeText['heading']) { echo '<h1 class="goBeyond">' . $homeText['heading'] . '</h1>'; }
              if($homeText['subtext']) { echo '<h3 class="goBeyondSubtext">' . $homeText['subtext'] . '</h3>'; }
              if($homeText['button']) {
                echo '<div class="buttonWrap">';
                  echo '<button class="withIcon"><span>' . $homeText['button'] . '</span> ' . wp_get_attachment_image($homeText['icon']['id'], 'small', false, array('class' => 'icon')) . '</button>';
                  echo '<div class="inputWrap"><label class="inputLabel" for="enterPhoneOne">enter your phone number</label><input id="enterPhoneOne" class="fieldInput enterPhone" type="tel" /></div>';
                echo '</div>';
              }
            echo '</div>';
            if($homeImage) { echo wp_get_attachment_image($homeImage['id'], 'large', false, array('class' => 'homeImage')); }
          }
        echo '</div>';
      }

      // SECTION: Features
      $featuresOver = get_field('features_overview');
      $featuresList = get_field('features');
      echo '<div class="contentBlock features">';
        if($featuresOver) {
          $image = $featuresOver['image'];
          $text = $featuresOver['text'];
          if($image) { echo wp_get_attachment_image($image['id'], 'large', false, array('class' => 'abePoint')); }
          if($text) {
            echo '<div class="featureText">';
              if($text['heading']) { echo '<h1 class="featureHeading">' . $text['heading'] . '</h1>'; }
              if($text['sub_heading']) { echo '<h3 class="featureSub">' . $text['sub_heading'] . '</h3>'; }
            echo '</div>';
          }
        }
        if($featuresList) {
          echo '<div class="featureItems">';
            foreach($featuresList as $feat) {
              echo '<div class="featureItem">';
                if($feat['icon']) { echo wp_get_attachment_image($feat['icon']['id'], 'large', false, array('class' => 'iconImg')); }
                if($feat['text'] || $feat['content']) {
                  echo '<div class="iconText">';
                    if($feat['text']['heading']) { echo '<h2 class="iconHeading">' . $feat['text']['heading'] . '</h2>'; }
                    if($feat['text']['content']) { echo '<p class="iconSub">' . $feat['text']['content'] . '</p>'; }
                  echo '</div>';
                }
              echo '</div>';
            }
          echo '</div>';
        }
      echo '</div>';

      // SECTION: Security
      $securityImg = get_field('security_image');
      $securityList = get_field('security_items');
      if($securityImg || $securityList) {
        echo '<div class="contentBlock security">';
          if($securityImg) { echo wp_get_attachment_image($securityImg['id'], 'large', false, array('class' => 'abeSign')); }
          if($securityList) {
            echo '<div class="safetySecurity">';
              foreach($securityList as $secure) {
                $icon = $secure['icon'];
                $hx = $secure['icon'] ? 'h2' : 'h1';
                $px = $secure['icon'] ? 'p' : 'h3';
                echo '<div class="securityItem">';
                  if($icon) { echo wp_get_attachment_image($icon['id'], 'medium'); }
                  echo '<' . $hx . '>' . $secure['text']['heading'] . '</' . $hx . '>';
                  echo '<' . $px . '>' . $secure['text']['content'] . '</' . $px . '>';
                echo '</div>';
              }
            echo '</div>';
          }
        echo '</div>';
      }

      // SECTION: Testimonials
      $testsWait = get_field('testimonial_waitlist');
      $testsList = get_field('testimonials');
      if($testsWait || $testsList) {
        echo '<div class="contentBlock testimonials">';
          if($testsWait) {
            echo '<div class="left"><div class="flexContainer">';
            if($testsWait['heading']) { echo '<h1 class="join">' . $testsWait['heading'] . '</h1>'; }
            if($testsWait['rating']) {
              $icon = $testsWait['rating']['icon'];
              $text = $testsWait['rating']['description'];
              $links = $testsWait['links'];
              if($icon) { echo wp_get_attachment_image($icon['id'], 'medium', false, array('classes' => 'fivestar')); }
              if($text) { echo '<h3 class="rating">' . $text . '</h3>'; }
              if($links) {
                echo '<div class="appStoreIcons">';
                  foreach($links as $link) {
                    if($link['link']['url']) { echo '<a href="' . $link['link']['url'] . '" class="appStoreLink" target="' . $link['link']['target'] . '">'; }
                      if($link['icon']) { echo wp_get_attachment_image($link['icon']['id'], 'small'); }
                    if($link['link']['url']) { echo '</a>'; }
                  }
                echo '</div>';
              }
            }
            echo '</div></div>';
          }
          if($testsList) {
            echo '<div class="right"><div class="flexContainer">';
              echo '<img class="quote" src="' . get_template_directory_uri() . '/images/quotes.png" alt="quote" />';
              foreach($testsList as $test) {
                $closeQuote = '<img class="upsideDownQuote" src="' . get_template_directory_uri() . '/images/quotes.png" alt="quote" />';
                if($test['quote']) { echo '<h3 class="testimonial">' . $test['quote'] . ' ' . $closeQuote . '</h3>'; }
                if($test['name']) { echo '<p class="quoteBy">&mdash; ' . $test['name'] . '</p>'; }
              }
            echo '</div></div>';
          }
        echo '</div>';
      }

      // SECTION: FAQ
      $faq = get_field('questions');
      $faqToggle = '<span class="accordionToggle"><div class="lines"><span class="line"></span><span class="line plus"></span></div></span>';
      if($faq) {
        echo '<div class="accordion">';
          foreach($faq as $q) {
            echo '<div class="leaf">';
              if($q['question']) { echo '<div class="leafHeading"><h2 class="accordionTitle">' . $q['question'] . '</h2>' . $faqToggle . '</div>'; }
              if($q['answer']) { echo '<div class="leafWrapper"><p class="leafContent">' . $q['answer'] . '</p></div>'; }
            echo '</div>';
          }
        echo '</div>';
      }
		}}
	get_footer();
?>
