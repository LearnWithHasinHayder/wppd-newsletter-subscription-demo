jQuery(document).ready(function ($) {
    $('#wpdbdemo-newsletter-form').on('submit', function (e) {
        e.preventDefault();
        const $form = $(this);
        const data = {
            action: 'wpdbdemo_subscribe',
            nonce: wpdbdemo_ajax.nonce,
            name: $form.find('[name="name"]').val(),
            email: $form.find('[name="email"]').val()
        };
        $form.find('button').prop('disabled', true);
        $form.find('.wpdbdemo-message').removeClass('error success').text('');
        $.post(wpdbdemo_ajax.ajax_url, data, function (response) {
            if (response.success) {
                $form.find('.wpdbdemo-message').addClass('success').text(response.data.message);
                $form[0].reset();
            } else {
                $form.find('.wpdbdemo-message').addClass('error').text(response.data.message);
            }
            $form.find('button').prop('disabled', false);
        });
    });
});
