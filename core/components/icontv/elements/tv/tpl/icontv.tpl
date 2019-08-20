<input id="tv{$tv->id}" name="tv{$tv->id}" type="text" class="textfield" value="{$tv_value|escape}"{$style}
       tvtype="{$tv->type}"/>
<div id="iconTV{$tv->id}"></div>
<div id="tvpanel{$tv->id}" style="width:100%"></div>
<script type="text/javascript">

    TVAdvanced{$tv->id} = MODx.load{literal}({
        {/literal}
        xtype: 'iconTV-panel',
        renderTo: 'iconTV{$tv->id}',
        tvFieldId: 'tv{$tv->id}',
        tvId: '{$tv->id}',
        record: {
            title2: "{$title2}"
        }
        {literal}
    });
    {/literal}
</script>
<!-- scripts -->
<script>
    var icons = {$icons};
    if (window.jQuery) {
        jQuery(document).ready(function ($) {

            jQuery('input[tvtype="icontv"]').fontIconPicker({
                source: icons,
                emptyIcon: false,
                hasSearch: true,
                defaultValue: true,
            });

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
        });
    }
</script>
<!-- /scripts -->
{$font_css}