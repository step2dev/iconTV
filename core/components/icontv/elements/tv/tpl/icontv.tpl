<div style="position: relative;">
    <input id="tv{$tv->id}" name="tv{$tv->id}" type="text" class="textfield" value="{$tv_value|escape}"{$style}
           tvtype="{$tv->type}"/>
    <div id="iconTV{$tv->id}"></div>
    <div id="tvpanel{$tv->id}" style="width:100%">
        {if $destroy == 1}
            <div class="destroy-api-buttons">
                <button type="button" class="x-btn-text destroy-button-destroy"><i class="icon icon-trash" aria-hidden="true"></i></button>
                <button type="button" class="x-btn-text destroy-button-restore" style="display: none;"><i class="icon icon-reply" aria-hidden="true"></i>
                </button>
            </div>
        {/if}
        {if $svg_parser == 1}
            <div id="rendered-svg" class="thumbnail" style="max-width: 350px;">
                <img src="lib/svgs/placeholder.png" alt="Live View" style="width: 100%; background: #ddd; padding: 20px;">
                <div class="caption">
                    <h3>Please Select…</h3>
                    <p>We also need to append the SVG source somewhere in the document, preferably before closing
                        <code>&lt;body&gt;</code> tag.</p>
                    <p>The following SVG is downloaded from <a href="http://www.kameleon.pics/">Kameleon</a> and bundled with <a
                                href="https://www.npmjs.com/package/svg-join">svg-join</a>.</p>
                    <p>Select an SVG below to see the content change.</p>
                    <input type="text" id="svg_renderer" value=""/>
                </div>
            </div>
            <script>
                var svgs = ['Multicolor', 'Bag-Present', 'Application-Map', 'Batman',
                    'Battery-Charging', 'Beach', 'Bell', 'Bonsai', 'Boss-2', 'Boss-3',
                    'Boss-5', 'Burglar', 'Bus', 'Businesswoman-1', 'Camera-Front',
                    'Candles', 'Canoe', 'Captain-Shield', 'Candy', 'Cement-Mixer',
                    'Car-Jumper', 'Checklist', 'Cheese', 'Cashier-2', 'Chair-4', 'Chat-2'];
                $('#svg_renderer').fontIconPicker({
                    source: svgs,
                    iconGenerator: function (item, flipBoxTitle, index) {
                        console.log(item);
                        return '<i style="display: flex; align-items: center; justify-content: center; height: 100%;"><svg style="height: 32px; width: auto;" class="svg-icon ' + item + '"><use xlink:href="#' + item + '"></use></svg></i>';
                    }
                })
                    .on('change', function () {
                        var item = $(this).val(),
                            liveView = $('#rendered-svg'),
                            liveTitle = liveView.find('h3'),
                            liveImage = liveView.find('img');
                        if ('' === item) {
                            liveTitle.html('Please Select…');
                            liveImage.attr('src', '/assets/lib/svgs/placeholder.png');
                            return;
                        }
                        liveTitle.html(item.split('-').join(' '));
                        liveImage.attr('src', '/assets/lib/svgs/parts/' + item + '.svg');
                    });

            </script>
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

            destroyButton = $('.destroy-button-destroy'),
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