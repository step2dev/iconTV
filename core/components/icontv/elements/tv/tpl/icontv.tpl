<div style="position: relative;">
    <div class="tv-block">
        <input id="tv{$tv->id}" name="tv{$tv->id}" type="text" class="textfield" value="{$tv_value|escape}"{$style}
               tvtype="{$tv->type}"/>
        <div id="iconTV{$tv->id}"></div>
        <div id="tvpanel{$tv->id}">
            {if $destroy == 1}
                <div class="destroy-api-buttons">
                    <button type="button" class="x-btn-text destroy-button-destroy" data-id="{$tv->id}">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt"
                             class="svg-inline--fa fa-trash-alt fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 448 512" width="12px">
                            <path fill="currentColor"
                                  d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
                        </svg>
                    </button>
                    <button type="button" class="x-btn-text destroy-button-restore"
                            data-id="{$tv->id}"
                            style="display: none;">
                        <i class="icon icon-reply" aria-hidden="true"></i>
                    </button>
                </div>
            {/if}
        </div>
    </div>
</div>

<!-- scripts -->
<script>
  var icons = {$icons};
  if (window.jQuery) {
    // jQuery(document).ready(function($) {

    var IconsTV{$tv->id} = jQuery('input[tvtype="icontv"]').fontIconPicker({
      source: icons,
      emptyIcon: {$emptyIcon},
      hasSearch: {$noSearch},
      iconsPerPage: {$iconsPerPage},
      autoClose: {$iconsAutoClose}
      //theme: 'fip-grey'
    })//,

    jQuery('.modx-tv-type-icontv .selector-button').click(function () {
      wrap = jQuery(this).closest('.vertical-tabs-body')

      if (wrap.height() < 400) {
        if (jQuery(this).find('i').hasClass('fip-icon-down-dir')) {
          if (!wrap.data('height')) {
            var newHeight = wrap.height() + parseInt({$iconsPerPage}) / 5 * 42 + 20
            var contentHeight = jQuery('#modx-panel-resource .modx-resource-content').height()
            if (contentHeight < newHeight) {
              newHeight = contentHeight
            }

            wrap.attr('data-height', wrap.height()).animate({
              height: wrap.height() + newHeight,
            })
          }
        }
      }
    })
  }
</script>
<!-- /scripts -->
{$font_css}
{$font_script}