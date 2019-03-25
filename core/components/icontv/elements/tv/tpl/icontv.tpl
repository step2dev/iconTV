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
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- styles -->
<!-- base | always include -->
<link rel="stylesheet" type="text/css"
      href="https://unpkg.com/@fonticonpicker/fonticonpicker/dist/css/base/jquery.fonticonpicker.min.css">
<!-- default grey-theme -->
<link rel="stylesheet" type="text/css"
      href="https://unpkg.com/@fonticonpicker/fonticonpicker/dist/css/themes/grey-theme/jquery.fonticonpicker.grey.min.css">

<!-- scripts -->
<script type="text/javascript"
        src="https://unpkg.com/@fonticonpicker/fonticonpicker/dist/js/jquery.fonticonpicker.min.js"></script>
{$font_css}
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var icons = {$icons};
        jQuery(document).ready(function ($) {
            $('#tv{$tv->id}').fontIconPicker({
                source: icons,
                emptyIcon: false,
                hasSearch: false,
                hasSearch: true,
                defaultValue: true,
            });
        });
    });
</script>
