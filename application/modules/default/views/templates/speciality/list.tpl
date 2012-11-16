{strip}
<table class="table table-bordered table-striped table-hover table-condensed table-centered table-hover-controls">
    <thead>
    <tr class="">
        <th class="">Специальность</th>
        <th class="">Группа</th>
    </tr>
    </thead>
    <tbody>
        {assign var=currentType value =""}
        {foreach from=$specialityList->getList() item=speciality}
            {assign var=groupList value=$speciality->getGroupCollection()}
            {if $currentType !== $speciality->getType()}
            <tr>
                <td colspan="4" class="centered"><h4 class="em">{$speciality->getTypeCaption()}</h4></td>
            </tr>
                {assign var=currentType value=$speciality->getType()}
            {/if}
        <tr>
            <td {if count( $groupList ) > 0 }rowspan="{count( $groupList)}"{/if} class="span6">
                {$speciality->getName()}
                <div class="btn-toolbar pull-right hover">
                    <div class="btn-group">
                        <div class="btn btn-mini btn-speciality-edit" title="Редактировать специальность"
                             data-id="{$speciality->getId()}"><i class="icon-pencil"></i></div>
                    </div>
                    <div class="btn-group">
                        <div class="btn btn-mini btn-primary btn-group-add" title="Добавить группу"
                             data-speciality-id="{$speciality->getId()}"><i class="icon-white icon-plus"></i></div>
                    </div>
                </div>
            </td>
            {foreach from=$groupList item=group}
                <td class="span6">{$group->getName()}
                    <div class="btn btn-mini btn-group-edit hover pull-right" title="Редактировать группу "
                         data-id="{$group->getId()}"
                         data-speciality-id="{$speciality->getId()}">
                        <i class="icon-pencil"></i></div>
                </td>
            </tr>
            <tr>
                {foreachelse}
                <td colspan="2">-</td>
            {/foreach}
        </tr>
            {foreachelse}
        <tr>
            <div class="alert alert-info">Нет специальностей для отображения</div>
        </tr>
        {/foreach}
    </tbody>
</table>
<script type="text/javascript">pages.speciality.list.init();</script>
{/strip}