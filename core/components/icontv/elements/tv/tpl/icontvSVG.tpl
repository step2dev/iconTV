<div style="position: relative;">
    <div id="tvpaneliconTVSVG{$tv->id}" style="width:100%">
        <div id="iconTVSVG{$tv->id}"></div>
        <input id="tviconTVSVG{$tv->id}" name="tv{$tv->id}" type="text" class="textfield"
               value="{$tv_value|escape}" {$style}
               tvtype="{$tv->type}"/>
        <div id="tvpanel{$tv->id}" style="width:100%">
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
                    <button type="button" class="x-btn-text destroy-button-restore destroy-button-restore"
                            data-id="{$tv->id}"
                            style="display: none;">
                        <i class="icon icon-reply" aria-hidden="true"></i>
                    </button>
                </div>
            {/if}
        </div>

        <div id="rendered-svg" class="thumbnail" style="max-width: 350px;">
            <div class="caption">
                <h3>{$tv_value|escape|default: 'Please Select…'}</h3>
            </div>
            {if $preview == 1}
                <p>Select an SVG below to see the content change.</p>
                <img src="/assets/components/icontv/placeholder.svg" alt="Live View"
                     style="width: 100%; background: #ddd; padding: 20px;">
            {/if}
        </div>
        <div style="display: none">
            {$sprite}
        </div>
        <script>
          var svgs{$tv->id} = {$svgs};
          var iconsSVG = '{$iconsSVG}';
          if (window.jQuery) {
            var IconsTV{$tv->id} = $('#tviconTVSVG{$tv->id}').fontIconPicker({
              source: svgs{$tv->id},
              iconGenerator: function(item, flipBoxTitle, index) {
                return '<i style="display: flex; align-items: center; justify-content: center; height: 100%;"><svg style="height: 32px; width: auto;" class="svg-icon ' +
                    item + '"><use xlink:href="#' + item + '"></use></svg></i>';
              },

            }).on('change', function() {
              var item = $(this).val(),
                  liveView = $('#rendered-svg'),
                  liveTitle = liveView.find('h3'),
                  liveImage = liveView.find('img');

              if ('' === item) {
                liveTitle.html("{$tv_value|escape|default: 'Please Select…'}");
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
          }
        </script>
    </div>
</div>