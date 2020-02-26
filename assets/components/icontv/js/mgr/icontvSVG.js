iconTVSVG = {};

iconTVSVG.panel = function (config) {
    config = config || {};
    Ext.get('modx-tv-reset-' + config.tvId).on('click', function () {
        //empty record
        config.record = [];
        Ext.get('tv' + config.tvId).dom.value = JSON.stringify(config.record);
    });

    Ext.apply(config, {
        border: false
        , width: '100%'
        , listeners: {}
        , items: [{}]
    });

    iconTVSVG.panel.superclass.constructor.call(this, config);
};

Ext.extend(iconTVSVG.panel, Ext.Container, {
    //handler functions
    //funcname: function(){...}
});

Ext.reg('iconTVSVG-panel', iconTVSVG.panel);