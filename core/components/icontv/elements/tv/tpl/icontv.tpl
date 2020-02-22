<div style="position: relative;">
    <input id="tv{$tv->id}" name="tv{$tv->id}" type="text" class="textfield" value="{$tv_value|escape}"{$style}
           tvtype="{$tv->type}"/>
    <div id="iconTV{$tv->id}"></div>
    <div id="tvpanel{$tv->id}" style="width:100%">
        {if $destroy == 1}
            <div class="destroy-api-buttons">
                <button type="button" class="x-btn-text destroy-button-destroy">
                    <i class="icon icon-trash" aria-hidden="true"></i
                </button>
                <button type="button" class="x-btn-text destroy-button-restore" style="display: none;">
                    <i class="icon icon-reply" aria-hidden="true"></i>
                </button>
            </div>
        {/if}
    </div>
</div>

<!-- scripts -->
<script>
    var icons = {$icons};
    if (window.jQuery) {
        jQuery(document).ready(function ($) {

            var destroyIconElement = jQuery('input[tvtype="icontv"]').fontIconPicker({
                source: icons,
                emptyIcon: {$emptyIcon},
                hasSearch: {$noSearch},
                iconsPerPage: {$iconsPerPage},
                autoClose: {$iconsAutoClose}
                //theme: 'fip-grey'
            });//,


            jQuery('.modx-tv-type-icontv .selector-button').click(function () {
                wrap = jQuery(this).closest('.vertical-tabs-body');

                if (wrap.height() < 400) {
                    if (jQuery(this).find('i').hasClass('fip-icon-down-dir')) {
                        if (!wrap.data('height')) {
                            wrap.attr('data-height', wrap.height()).animate({
                                height: wrap.height() + 280
                            });
                        }
                    } else {
                        if (wrap.data('height')) {
                            wrap.animate({
                                height: wrap.attr('data-height')
                            });
                            wrap.removeAttr('data-height');
                        }
                    }
                }
            });

            /**
             * Destroy API
             */
            // Get the variables - Icon Picker and buttons

            destroyButton = $('.destroy-button-destroy');
                restoreButton = $('.destroy-button-restore');

            // Attach the events
            destroyButton.on('click', function () {
                // Destroy the picker
                destroyIconElement.destroyPicker();

                // Change appearance
                destroyButton.hide();
                restoreButton.fadeIn('fast');
            });

            restoreButton.on('click', function () {
                // Restore the picker
                destroyIconElement.refreshPicker();

                // Change appearance
                restoreButton.hide();
                destroyButton.fadeIn('fast');
            });
        });
    }
</script>
<!-- /scripts -->
{$font_css}