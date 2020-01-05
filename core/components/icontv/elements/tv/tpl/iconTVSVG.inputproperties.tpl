<div id="tvIconTv-input-properties-form"></div>
<span style="color: red"> Внимание компонент работает некоректно</span>
{literal}
<script type="text/javascript">
    var iconTvSVG = function (config) {
        config = config || {};
        config.connectorUrl = {/literal}{$connector}{literal};
        config.default_path = {/literal}{$default_path}{literal};
        iconTvSVG.superclass.constructor.call(this, config);
    };

    Ext.extend(iconTvSVG, Ext.Component, {
        page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {},

    });
    Ext.reg('iconTvSVG', iconTvSVG);
    iconTvSVG = new iconTvSVG();

    iconTvSVG.panel.CreateType = function (config) {
        config = config || {};
        if (!config.id) {
            config.id = 'jobs-type-window-create';
        }
        Ext.applyIf(config,
            {
                xtype: 'container',
                border: false,
                layout: 'form',
                labelAlign: 'top',
                labelSeparator: '',
                width: '100%',
                anchorSize: {width: '98%', height: 'auto'},
                hideLabel: true,
                items: [{
                    xtype: 'textfield',
                    fieldLabel: _('iconstvsvg.desc'),
                    name: 'inopt_iconstvsvg',
                    hiddenName: 'inopt_iconstvsvg',
                    id: 'inopt_iconstvsvg{/literal}{$tv}{literal}',
                    autoSelect: true,
                    allowBlank: false,
                    autoHeight: true,
                    editable: true,
                    triggerAction: 'all',
                    typeAhead: true,
                    width: '100%',
                    displayField: 'name',
                    valueField: 'name',
                    defaultValue: iconTvSVG.default_path,
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
                            //console.log(r);
                            //So now we are going to set the combobox value here.
                            //I just simply used my default value in the combobox definition but it's possible to query from combobox store also.
                            //For example: store.getAt('0').get('id'); according to Brik's answer.
                            this.setValue(this.defaultValue);
                        }
                    }
                }]
            }
        );

        iconTvSVG.panel.CreateType.superclass.constructor.call(this, config);
    };
    Ext.extend(iconTvSVG.panel.CreateType, MODx.Panel);
    Ext.reg('jobs-type-window-create', iconTvSVG.panel.CreateType);

    // <![CDATA[
    MODx.load({
        xtype: 'panel'
        , layout: 'form'
        , autoHeight: true
        , labelWidth: 150
        , border: false
        , items: [{xtype: 'jobs-type-window-create'}]
        , renderTo: 'tvIconTv-input-properties-form'
    });
    // ]]>
</script>
{/literal}