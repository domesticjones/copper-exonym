<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<title><?php wp_title(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<?php wp_head(); ?>
        <script type="text/javascript">
            (function(b,r,a,n,c,h,_,s,d,k){if(!b[n]||!b[n]._q){for(;s<_.length;)c(h,_[s++]);d=r.createElement(a);d.async=1;d.src="https://cdn.branch.io/branch-latest.min.js";k=r.getElementsByTagName(a)[0];k.parentNode.insertBefore(d,k);b[n]=h}})(window,document,"script","branch",function(b,r){b[r]=function(){b._q.push([r,arguments])}},{_q:[],_v:1},"addListener applyCode autoAppIndex banner closeBanner closeJourney creditHistory credits data deepview deepviewCta first getCode init link logout redeem referrals removeListener sendSMS setBranchViewData setIdentity track validateCode trackCommerceEvent logEvent disableTracking getBrowserFingerprintId crossPlatformIds lastAttributedTouchData".split(" "), 0);

            branch.init('key_live_coPAtZZnpBpRrY4zaPCrVpipwzbtrKOC');
            function sendSMS(form) {
                const phoneNumber = form.enterPhoneOne ? form.enterPhoneOne.value : form.enterPhoneTwo.value;
                const linkData = {
                    tags: [],
                    channel: 'Website',
                    feature: 'TextMeApp',
                    data: {
                        'foo': 'bar'
                    }
                };

                const callback = function(err, result) {
                    if(err)
                        alert("Oof! Text isn't vibing right now.");
                    else
                        alert("Yay! Text is on its way!");
                };

                branch.sendSMS(phoneNumber, linkData, {}, callback);
            }
        </script>
	</head>
	<body itemscope itemtype="http://schema.org/WebPage">
		<div class="navbarWrapper">
				<nav class="navbar">
					<a data-value="home" class="navitem space" href="#home"><img src="<?php the_field('header_logo', 'options'); ?>" alt="copper" /></a>
					<a data-value="features" class="navitem" href="#features">Features</a>
					<a data-value="security" class="navitem" href="#security">Safety &amp; Security</a>
					<a data-value="testimonials" class="navitem" href="#testimonials">Testimonials</a>
					<a data-value="faq" class="navitem" href="#faq">FAQ</a>
				</nav>
				<nav class="navbar navbarMobile hidden">
					<a data-value="home" class="navitem mobile" href="#home"><img src="<?php the_field('header_logo', 'options'); ?>" alt="copper" /></a>
					<div class="buttonAndNav">
						<div class="buttonWrap">
							<button id="downloadOne" class="navitemButton button space">Download the App</button>
						</div>
						<div class="navburger">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
				</nav>
				<div class="absoluteMenu">
					<a data-value="features" class="navitem" href="#features">Features</a>
					<a data-value="security" class="navitem" href="#security">Safety &amp; Security</a>
					<a data-value="testimonials" class="navitem" href="#testimonials">Testimonials</a>
					<a data-value="faq" class="navitem" href="#faq">FAQ</a>
				</div>
		</div>
		<div class="content">
