{if $acl->isAvailable( Model_ACL::TASK_QA_TEST_PLAN_VIEW )}
    {assign var="iEditable" value= $acl->isAvailable( Model_ACL::TASK_QA_TEST_PLAN_EDIT )}

<div id="tpList" class="container-fluid">
    <div style="overflow: hidden;" class="btn-toolbar">
        {if $iEditable}
            <button id="btnCreateNewTP" class="btn btn-primary pull-right"><i class="icon-white icon-plus"></i> Create new Test Plan</button>
        {/if}
        <h3>Test Plans</h3>
    </div>
    <table class="table table-bordered table-striped table-condensed">
        <colgroup>
            <col class="span1">
            <col class="span5">
            <col class="">
            <col class="span2">
        </colgroup>
        <thead>
        <tr>
            <th>Active</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            {foreach from=$this->o item=plan}
            <tr data-id="{$plan->getId()}">
                <td>{if $plan->getActive()}ON{else}OFF{/if}</td>
                <td>{$plan->getName()}</td>
                <td>{$plan->getDescription()}</td>
                <td>
                    <button class="btnTPView btn btn-mini"><i class="icon icon-eye-open"></i> View</button>
                    {if $iEditable}
                        <button class="btnTPEdit btn btn-mini"><i class="icon icon-edit"></i> Edit</button>
                    {/if}
                </td>
            </tr>
            {/foreach}
        </tbody>
    </table>
</div>
<script type="text/javascript">qa.testplan.main.init()</script>
{/if}