if (window.jQuery) {
    jQuery(document).ready(function ($) {
        if (typeof  iconTvTemplate !== 'undefined') {
            jQuery('#modx-template-icon').fontIconPicker({
                source: iconTvTemplate.baseicon,
                emptyIcon: iconTvTemplate.emptyIcon,
                hasSearch: 1,
                iconsPerPage: iconTvTemplate.iconsPerPage,
                autoClose: iconTvTemplate.iconsAutoClose
                //theme: \'fip-grey\'
            });
        }
    });
}