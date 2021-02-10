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
  $(document).on('click', '.destroy-button-destroy', function() {
    var $this = $(this);
    var $id = $this.data('id');

    // Destroy the picker
    window['IconsTV' + $id].destroyPicker();

    // Change appearance
    $this.hide();
    $this.parent().find('.destroy-button-restore').fadeIn('fast');
  });

  $(document).on('click', '.destroy-button-restore', function() {
    var $this = $(this);
    var $id = $this.data('id');

    // Restore the picker
    window['IconsTV' + $id].refreshPicker();

    // Change appearance
    $this.hide();
    $this.parent().find('.destroy-button-destroy').fadeIn('fast');
  });
}