<div style="position: relative;">
    <div id="tvpaneliconTVSVG{$tv->id}" style="width:100%">
        <div id="iconTVSVG{$tv->id}"></div>
        <input id="tviconTVSVG{$tv->id}" name="tv{$tv->id}" type="text" class="textfield"
               value="{$tv_value|escape}"{$style}
               tvtype="{$tv->type}"/>
        <div id="rendered-svg" class="thumbnail" style="max-width: 350px;">

            <div class="caption">
                <h3>Please Select…</h3>
                <p>Select an SVG below to see the content change.</p>

            </div>
            <img src="/assets/components/icontv/placeholder.svg" alt="Live View"
                 style="width: 100%; background: #ddd; padding: 20px;">
        </div>

        {$sprite}

        <script>
          var svgs = {$svgs};
          var iconsSVG = '{$iconsSVG}';
          $('#tviconTVSVG{$tv->id}').fontIconPicker({
            source: svgs,
            iconGenerator: function(item, flipBoxTitle, index) {
              console.log(item);
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
              liveImage.attr('src', '/assets/components/icontv/placeholder.svg');
              return;
            }
            liveTitle.html(item.split('-').join(' '));
            liveImage.attr('src', iconsSVG + item + '.svg');
          });

        </script>
    </div>
</div>