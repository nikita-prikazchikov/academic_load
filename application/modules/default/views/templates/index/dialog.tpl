<div id="environment_details" class="modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>{$environment->getName()}: Edit</h3>
    </div>
    <div class="modal-body">
        <div class="form-horizontal row-fluid">
            <fieldset>
                <div class="control-group">
                    <label class="control-label">Id</label>

                    <div class="controls">
                        <input type="text" class="span12" value="{$environment->getId()}" placeholder="Id" data-name="id_environment"
                               disabled="disabled"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Active</label>

                    <div class="controls">
                        <div class="btn-group item-active" data-toggle="buttons-radio">
                            <button class="btn {if $environment->getActive() == 1 || $environment->getActive() === null}active{/if}" data-value="1">
                                Yes
                            </button>
                            <button class="btn {if $environment->getActive() === 0}active{/if}" data-value="0">No</button>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Name</label>

                    <div class="controls">
                        <input type="text" class="span12" value="{$environment->getName()}" data-name="name"
                               {if $disabled}disabled="disabled"{/if}/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Node</label>

                    <div class="controls">
                        <select data-name="id_node" class="span12" {if $disabled}disabled="disabled"{/if}>
                            {html_options options=$filter->getNodesArrayList() selected=$environment->getIdNodeFk()}
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Port</label>

                    <div class="controls">
                        <div class="input-prepend span12">
                            <span class="add-on">80</span><input type="text" class="span4" value="{$environment->getPortLastDigits()}" placeholder="Port ..."
                                                                 data-name="port" maxlength="2"/>
                            <span class="help-inline">Only 2 last port digits allowed</span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Base instance</label>

                    <div class="controls">
                        <select data-name="id_base_instance" class="span12" {if $disabled}disabled="disabled"{/if}>
                            {html_options options=$filter->getBaseInstanceNodesList() selected=$environment->getIdBaseInstanceFk()}
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">User</label>

                    <div class="controls">
                        <input type="text" class="span12"
                               value="{if $environment->iFree()}Free{else}{$environment->getUser()} till {$environment->getTimestamp()}{/if}"
                               data-name="id_user" disabled="disabled"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Build(Tag)</label>

                    <div class="controls">
                        <input type="text" class="span12" value="{$environment->getBuild()|default:"-"}({$environment->getTag()|default:"-"})"
                               placeholder="Id"
                               data-name="build" disabled="disabled"/>
                    </div>
                </div>
            </fieldset>
        </div>
        <div id="modal_alert" class="alert alert-error fade in" style="display: none"></div>
    </div>
    <div class="modal-footer">
        {if !$disabled}
            <a href="#" class="btn btn-primary btn-environment-save"><i class="icon-ok icon-white"></i> Save</a>
        {/if}
        <a href="#" class="btn" data-dismiss="modal"><i class="icon-ban-circle"></i> Close</a>
    </div>
</div>
<script type="text/javascript">tenac.environment.dialog.edit.init();</script>
{/if}