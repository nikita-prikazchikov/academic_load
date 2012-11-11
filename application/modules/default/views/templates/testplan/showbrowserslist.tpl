{if $acl->isAvailable( Model_ACL::TASK_QA_TEST_PLAN_VIEW )}
<ul>
{foreach from=$this->browsers item=b}
    <li>{$b->getName()}</li>
{/foreach}
</ul>
{/if}