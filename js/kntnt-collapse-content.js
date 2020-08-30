jQuery(document).ready(function ($) {
    $('.kntnt-collapse-content > div > .kntnt-collapse-content-body').slideUp('slow');
    $('.kntnt-collapse-content > div > .kntnt-collapse-content-heading').click(function (e) {
        e.preventDefault();
        let $heading = $(this);
        let $body = $heading.next();
        let $panel = $heading.parent();
        let $container = $panel.parent();
        $panel.toggleClass('open');
        $body.slideToggle('slow');
        if ($container.hasClass('single')) {
            $panel.siblings('.open').each(function () {
                let $this = $(this);
                $this.removeClass('open');
                $this.children('.kntnt-collapse-content-body').slideUp('slow');
            });
        }
    });
});
