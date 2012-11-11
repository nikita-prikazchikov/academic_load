{if $acl->isAvailable( Model_ACL::TASK_QA_TEST_PLAN_EDIT )}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><i class="icon icon-remove"></i></button>
    <h3>Manage Suites</h3>
</div>
<div class="modal-body">
    <div class="row-fluid">
        <div class="span12">
            <div id="tpSuites" class="row-fluid">
                <div class="wqa_dnd_list span6">
                    <ul id="NotAssigned" class="connectedSortable wqa_dnd_sort">
                        {foreach from=$this->suitesNotAssigned item=suite}
                            <li id="{$suite->getId()}" class="ui-state-default">{$suite->getName()}</li>
                        {/foreach}
                    </ul>
                </div>
                <div class="wqa_dnd_list span6" style="float: right;">
                    <ul id="Assigned" class="connectedSortable wqa_dnd_sort">
                        {foreach from=$this->suitesAssigned item=suite}
                            <li id="{$suite->getId()}" class="ui-state-default">{$suite->getName()}</li>
                        {/foreach}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button href="#" class="btn" data-dismiss="modal"><i class="icon icon-remove"></i> Close</button>
    <button href="#" class="btn btn-primary" data-loading-text="Saving..."><i class="icon-white icon-ok"></i> Save</button>
</div>
{/if}