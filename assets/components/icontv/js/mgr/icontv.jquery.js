if (window.jQuery) {
  jQuery(document).ready(function($) {
    if (typeof iconTvTemplate !== 'undefined') {
      jQuery('#modx-template-icon').fontIconPicker({
        source: iconTvTemplate.baseicon,
        emptyIcon: iconTvTemplate.emptyIcon,
        hasSearch: 1,
        iconsPerPage: iconTvTemplate.iconsPerPage,
        autoClose: iconTvTemplate.iconsAutoClose,
        //theme: \'fip-grey\'
      });
    }
  });

  /**
   * Destroy API
   */

  // Attach the events
  $('.destroy-button-destroy').on('click', function() {
    var $id = $(this).data('id');

    // Destroy the picker
    window['IconsTV' + $id].destroyPicker();

    // Change appearance
    $(this).hide();
    $(this).parent().find('.destroy-button-restore').fadeIn('fast');
  });

  $('.destroy-button-restore').on('click', function() {
    var $id = $(this).data('id');

    // Restore the picker
    window['IconsTV' + $id].refreshPicker();

    // Change appearance
    $(this).hide();
    $(this).parent().find('.destroy-button-destroy').fadeIn('fast');
  });
}