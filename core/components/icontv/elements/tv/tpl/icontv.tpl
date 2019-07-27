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

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<!-- styles -->
<!-- base | always include -->
<link rel="stylesheet" type="text/css"
      href="https://unpkg.com/@fonticonpicker/fonticonpicker/dist/css/base/jquery.fonticonpicker.min.css">
<!-- default grey-theme -->
<link rel="stylesheet" type="text/css"
      href="https://unpkg.com/@fonticonpicker/fonticonpicker/dist/css/themes/grey-theme/jquery.fonticonpicker.grey.min.css">
{$font_css}
<!-- scripts -->
<script type="text/javascript"
        src="https://unpkg.com/@fonticonpicker/fonticonpicker/dist/js/jquery.fonticonpicker.min.js"></script>

<script type="text/javascript">
    window.onload = function () {
        if (window.jQuery) {
            jQuery(document).ready(function ($) {
                var icons = {$icons};

                jQuery('#tv{$tv->id}').fontIconPicker({
                    source: icons,
                    emptyIcon: false,
                    hasSearch: true,
                    defaultValue: true,
                });

                jQuery('#tv{$tv->id}-tr .selector-button').click(function () {
                    wrap = jQuery(this).closest('.vertical-tabs-body');
                    
                    if (wrap.height() < 400) {
                        if (jQuery(this).find('i').hasClass('fip-icon-down-dir')) {
                            if (!wrap.data('height')){
                                wrap.attr('data-height', wrap.height()).animate({
                                    height: wrap.height() + 280
                                });
                            }
                        } else {
                            if (wrap.data('height')){
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
    }
</script>
