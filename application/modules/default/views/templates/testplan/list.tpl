{if $acl->isAvailable( Model_ACL::TASK_QA_TEST_PLAN_VIEW )}
<ul class="nav nav-pills nav-stacked">
{foreach from=$this->o item=plan}
    <li data-plan-id="{$plan->getId()}" data-suites=";{foreach from=$plan->getSuites() item=suite}{$suite->getId()};{/foreach}">
        <a href="#" class="dashboard_item">
            ({count($plan->getSuites())})
            <i class="icon {if $plan->getActive()}icon-play{else}icon-stop{/if} boostrap-tooltip" data-original-title="{if $plan->getActive()}On{else}Off{/if}" class="boostrap-tooltip"></i>
            {$plan->getName()}
            <i class="icon icon-info-sign pull-right boostrap-tooltip" data-original-title="{if $plan->getDescription()}{$plan->getDescription()}{else}[nothing]{/if}" class="boostrap-tooltip"></i>
        </a>
    </li>
{/foreach}
</ul>
{/if}