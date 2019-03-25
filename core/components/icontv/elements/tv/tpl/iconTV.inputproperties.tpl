<div id="tv-input-properties-form{$tv}"></div>
{literal}

<script type="text/javascript">
    var iconTv = function (config) {
        config = config || {};
        config.connectorUrl = {/literal}{$connector}{literal};
        config.default = {/literal}{$tv_input_properties}{literal};
        iconTv.superclass.constructor.call(this, config);
    };
    Ext.extend(iconTv, Ext.Component, {
        page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {},

    });
    Ext.reg('icontv', iconTv);
    iconTv = new iconTv();

    iconTv.panel.CreateType = function (config) {
        config = config || {};
        if (!config.id) {
            config.id = 'jobs-type-window-create';
        }
        Ext.applyIf(config,
            {
                xtype: 'container'
                , border: false
                , layout: 'form'
                , labelAlign: 'top'
                , labelSeparator: ''
                , width: '100%'
                , anchorSize: {width: '98%', height: 'auto'},
                hideLabel: true,
                items: [{
                    xtype: 'combo',
                    fieldLabel: 'icons',
                    name: 'inopt_icons',
                    hiddenName: 'inopt_icons',
                    id: 'inopt_icons{/literal}{$tv}{literal}',
                    autoSelect: true,
                    allowBlank: false,
                    editable: false,
                    triggerAction: 'all',
                    typeAhead: true,
                    width: 220,
                    listWidth: 220,
                    enableKeyEvents: true,
                    mode: 'store',
                    store: new Ext.data.JsonStore({
                        url: iconTv.connectorUrl,
                        root: 'results',

                        baseParams: {
                            action: 'mgr/config/getlist'
                        },
                        fields: ['name'],

                        autoLoad: true

                    }),
                    displayField: 'name',
                    valueField: 'name',
                    defaultValue: iconTv.default,
                    listeners: {
                        success: {
                            fn: function () {
                                console.log('success')
                            }, scope: this
                        },
                        error: {
                            fn: function () {
                                console.log('error')
                            }, scope: this
                        },
                        afterrender: function (r) {
                            console.log(r);
                            //So now we are going to set the combobox value here.
                            //I just simply used my default value in the combobox definition but it's possible to query from combobox store also.
                            //For example: store.getAt('0').get('id'); according to Brik's answer.
                            this.setValue(this.defaultValue);
                        }
                    }
                }]
            }
        );

        iconTv.panel.CreateType.superclass.constructor.call(this, config);
    };
    Ext.extend(iconTv.panel.CreateType, MODx.Panel);
    Ext.reg('jobs-type-window-create', iconTv.panel.CreateType);

    // <![CDATA[
    MODx.load({
        xtype: 'panel'
        , layout: 'form'
        , autoHeight: true
        , labelWidth: 150
        , border: false
        , items: [{xtype: 'jobs-type-window-create'}]
        , renderTo: 'tv-input-properties-form{/literal}{$tv}{literal}'
    });
    // ]]>
</script>
{/literal}