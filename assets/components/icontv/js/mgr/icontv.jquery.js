window.addEventListener('load', function () {
    if (window.jQuery) {
        if (typeof iconTvTemplate !== 'undefined') {
            jQuery('#modx-template-icon').fontIconPicker({
                source: iconTvTemplate.baseicon,
                emptyIcon: iconTvTemplate.emptyIcon,
                hasSearch: 1,
                iconsPerPage: iconTvTemplate.iconsPerPage,
                autoClose: iconTvTemplate.iconsAutoClose,
                //theme: \'fip-grey\'
            })
        }
    }
})

/**
 * Destroy/Restore API
 */

// Attach the events
jQuery(document).on('click', '.destroy-button-destroy, .destroy-button-restore', function () {
    var $this = jQuery(this)
    var $id = $this.data('id')

    // Change appearance
    $this.hide()

    if ($this.hasClass('destroy-button-destroy')) {
        // Destroy the picker
        window['IconsTV' + $id].destroyPicker()
        $this.parent().find('.destroy-button-restore').fadeIn('fast')
    } else {
        // Restore the picker
        window['IconsTV' + $id].refreshPicker()
        $this.parent().find('.destroy-button-destroy').fadeIn('fast')
    }

})
