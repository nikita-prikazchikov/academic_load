{if $acl->isAvailable( Model_ACL::TASK_QA_TEST_PLAN_EDIT )}
<input id="tpId" type="hidden" name="id" value="{$o->getId()}">
<div id="frmTestPlan" class="container-fluid">
    <div class="full-width" style="overflow: hidden;">
        <h2>Test plan</h2>
    </div>

    <div id="msgError" class="invalid">{$this->msgError}</div>

    <div class="row-fluid">
        <label>Status</label>
        <select id="tpActive" name="active" style="font-weight:bold;">
            <option id="active" value="1" {if $o->getActive()}selected="selected"{/if}>Active</option>
            <option id="inactive" value="0" {if !$o->getActive()}selected="selected"{/if}>Inactive</option>
        </select>
    </div>
    <div class="row-fluid">
        <label>Name</label>
        <input id="tpName" name="name" value="{$o->getName()}" class="span12" type="text"/>
    </div>
    <div class="row-fluid">
        <label>Short description</label>
        <textarea id="tpDescription" name="description" rows="2" class="span12">{$o->getDescription()}</textarea>
    </div>
    <div class="row-fluid">
        <label>Full description</label>
        <textarea id="tpText" name="text" rows="20" class="span12">{$o->getText()}</textarea>
    </div>
    <div class="form-actions">
        <div class="pull-right">
            <button id="btnSave" type="button" class="btn btn-primary"><i class="icon-white icon-ok"></i> Save</button>
            <button id="btnCancel" type="button" class="btn"><i class="icon icon-remove"></i> Cancel</button>
        </div>
    </div>
    {if $o->getId() != -1}
        <div class="row-fluid">
            {*<div id="popupManage" style="display: none;">
                <div id="loadingMask" class="mask">Loading...</div>
                <div id="popupManageContent"></div>
            </div>*}
            <div class="span6">
                <h3>Test Suites <button id="btnManageSuites" class="btn btn-mini"><i class="icon icon-edit"></i> Manage Suites</button></h3>
                <div id="tpTestSuites">
                    <ul>
                        {foreach from=$this->suites item=suite}
                            <li>
                                {$suite->getName()}
                            </li>
                            <label class="description">{$suite->getDescription()}</label>
                        {/foreach}
                    </ul>
                </div>
            </div>
            <div class="span6">
                <h3>Browsers <button id="btnManageBrowsers" class="btn btn-mini"><i class="icon icon-edit"></i> Manage Browsers</button></h3>
                <div id="tpBrowsers">
                    <ul>
                        {foreach from=$this->browsers item=b}
                            <li>{$b->getName()}</li>
                        {/foreach}
                    </ul>
                </div>
            </div>
            {else}
            In order to add test suites and browsers the test plan has be saved.
        </div>
    {/if}
</div>

<div id="popupManage" class="modal hide fade in" style="display: none; width: 800px; margin: -400px 0 0 -400px;"></div>

<script type="text/javascript">qa.testplan.pageEdit.init()</script>
{/if}