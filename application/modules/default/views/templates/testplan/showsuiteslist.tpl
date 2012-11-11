{if $acl->isAvailable( Model_ACL::TASK_QA_TEST_PLAN_VIEW )}
<ul>
{foreach from=$this->suites item=suite}
    <li>
        {$suite->getName()}
    </li>
    <label class="description">{$suite->getDescription()}</label>
{/foreach}
</ul>
{/if}