<div style="position: relative;">
    <div id="tvpaneliconTVSVG{$tv->id}" style="width:100%">
        <div id="iconTVSVG{$tv->id}"></div>
        <input id="tviconTVSVG{$tv->id}" name="tv{$tv->id}" type="text" class="textfield"
               value="{$tv_value|escape}"{$style}
               tvtype="{$tv->type}"/>
        <div id="tvpanel{$tv->id}" style="width:100%">
            {if $destroy == 1}
                <div class="destroy-api-buttons">
                    <button type="button" class="x-btn-text destroy-button-destroy">
                        <i class="icon icon-trash" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="x-btn-text destroy-button-restore" style="display: none;">
                        <i class="icon icon-reply" aria-hidden="true"></i>
                    </button>
                </div>
            {/if}
        </div>

        <div id="rendered-svg" class="thumbnail" style="max-width: 350px;">
            <div class="caption">
                <h3>Please Select…</h3>
            </div>
            {if $preview == 1}
                <p>Select an SVG below to see the content change.</p>
                <img src="/assets/components/icontv/placeholder.svg" alt="Live View"
                     style="width: 100%; background: #ddd; padding: 20px;">
            {/if}
        </div>

        {$sprite}

        <script>
          var svgs = {$svgs};
          var iconsSVG = '{$iconsSVG}';
          console.log(svgs);
          console.log(iconsSVG);
          if (window.jQuery) {
            jQuery(document).ready(function($) {
              var destroySVGElement = $('#tviconTVSVG{$tv->id}').fontIconPicker({
                source: svgs,
                iconGenerator: function(item, flipBoxTitle, index) {
                  console.log(item);
                  console.log(flipBoxTitle);
                  console.log(index);
                  return '<i style="display: flex; align-items: center; justify-content: center; height: 100%;"><svg style="height: 32px; width: auto;" class="svg-icon ' +
                      item + '"><use xlink:href="#' + item + '"></use></svg></i>';
                },

              }).on('change', function() {
                var item = $(this).val(),
                    liveView = $('#rendered-svg'),
                    liveTitle = liveView.find('h3'),
                    liveImage = liveView.find('img');
                if ('' === item) {
                  liveTitle.html('Please Select…');
                    {if $preview == 1}
                  liveImage.attr('src', '/assets/components/icontv/placeholder.svg');
                    {/if}
                  return;
                }
                liveTitle.html(item.split('-').join(' '));
                  {if $preview == 1}
                liveImage.attr('src', iconsSVG + '/' + item + '.svg');
                  {/if}
              });

              /**
               * Destroy API
               */
              // Get the variables - Icon Picker and buttons

              destroyButton = $('.destroy-button-destroy');
              restoreButton = $('.destroy-button-restore');

              // Attach the events
              destroyButton.on('click', function() {
                // Destroy the picker
                destroySVGElement.destroyPicker();

                // Change appearance
                destroyButton.hide();
                restoreButton.fadeIn('fast');
              });

              restoreButton.on('click', function() {
                // Restore the picker
                destroySVGElement.refreshPicker();

                // Change appearance
                restoreButton.hide();
                destroyButton.fadeIn('fast');
              });
            });
          }
          ;
        </script>
    </div>
</div>