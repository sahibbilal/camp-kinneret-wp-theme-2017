(function($) {

var CountDown = {
	init: function () {
		this.tabs();
		this.timer();
	},

	tabs: function () {
		$('.countdown-tab').on('click', function () {
			$('.countdown-tab, .countdown-content > div').removeClass('active');
			$(this).addClass('active');
			$('#' + $(this).attr('data-tab')).addClass('active');
		});
	},

	timer: function () {
		$('.countdown-timer').each(function () {
			var time = moment($(this).attr('data-time'), "YYYY-MM-DD HH:mm:ss").toDate();
			var siteTime = moment($(this).attr('data-site-time')).valueOf();

			var timeCorrection = Date.now() - siteTime;

			var timeWrapper = $(this);
			var winWidth = $(window).width();

			setInterval(function () {
				var differanceInSeconds = moment().diff(time, 'seconds') - Math.round(timeCorrection / 1000);
				var differance = moment.duration(differanceInSeconds, 'seconds');
				var html = differance.format("D : H : mm : ss");

				if( html.charAt( 0 ) === '-' )
				html = html.slice( 1 );

				var values = html.split(' : ');


				if ( values.length === 4) {

					html = '<span data-text="days">' + values[0] + '</span> : ';
					html += '<span data-text="hrs">' + values[1] + '</span> : ';
					html += '<span data-text="min">' + values[2] + '</span> ';

					if (winWidth > 587) {
						html += '<div class="semi">:</div> <span data-text="sec" class="sec">' + values[3] + '</span>';
					}

					} else {

					html = '<span data-text="days">' + '0' + '</span> : ';

					html += '<span data-text="hrs">' + values[0] + '</span> : ';

					html += '<span data-text="min">' + values[1] + '</span> ';

					if (winWidth > 587) {
						html += '<div class="semi">:</div> <span data-text="sec" class="sec">' + values[2] + '</span>';
					}

				}

				timeWrapper.html(html);
			}, 100);
		});
	}
};

$(document).ready(function () {
	CountDown.init();
});

})( jQuery );