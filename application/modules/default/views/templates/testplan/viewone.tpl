{if $acl->isAvailable( Model_ACL::TASK_QA_TEST_PLAN_VIEW )}
<div class="container-fluid">
    <input id="tpId" type="hidden" name="id" value="{$o->getId()}">

    <div class="full-width" style="overflow: hidden;">
        <button id="btnBack" class="btn pull-left"><i class="icon icon-chevron-left"></i> Back</button>
        {if $acl->isAvailable( Model_ACL::TASK_QA_TEST_PLAN_EDIT )}
            <button id="btnEdit" class="btn pull-right"><i class="icon icon-edit"></i> Edit</button>
        {/if}
    </div>
    <div class="wqa_tp_viewback">
        <div style="width: 900px;margin: 0 auto;">
            <div class="wqa_tp_viewcontent">
                <div class="left full-width">
                    <h1>{$o->getName()}</h1>
                </div>
                <div class="left">
                    <h3 class="header">Short description</h3>

                    <div class="left full-width">{$o->getDescription()}</div>
                    <h3 class="header">Full description</h3>

                    <div class="left full-width">{$o->getText()}</div>
                </div>

                <div class="left">
                    <hr/>
                    <div class="left items-list">
                        <h3 class="header">Test Suites</h3>

                        <div id="tpTestSuites" class="left full-width">
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
                    <div class="left items-list">
                        <h3 class="header">Browsers</h3>

                        <div id="tpBrowsers" class="left full-width">
                            <ul>
                                {foreach from=$this->browsers item=b}
                                    <li>{$b->getName()}</li>
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">qa.testplan.pageView.init()</script>
{/if}