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
            var timeWrapper = $(this);

            setInterval(function () {
                var differanceInSeconds = moment().diff(time, 'seconds');
                var differance = moment.duration(differanceInSeconds, 'seconds');
                var html = differance.format("D : H : mm : ss");

                if( html.charAt( 0 ) === '-' )
                    html = html.slice( 1 );

                var values = html.split(' : ');


                html = '<span data-text="days">' + values[0] + '</span> : ';
                html += '<span data-text="hrs">' + values[1] + '</span> : ';
                html += '<span data-text="min">' + values[2] + '</span> : ';
                html += '<span data-text="sec">' + values[3] + '</span>';

                timeWrapper.html(html);
            }, 100);
        });
    }
};

$(document).ready(function () {
    CountDown.init();
});
