<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr class="">
        <th class="">Специальность</th>
        <th class="">Группа</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$specialityList->getList() item=speciality}
        {assign var=groupList value=$speciality->getGroupCollection()}
    <tr>
        <td {if count( $groupList ) > 0 }rowspan="{count( $groupList)}"{/if}>{$speciality->getName()}</td>
        {foreach from=$groupList item=group}
            <td>{$year->getName()}</td>
        </tr>
        <tr>
            {foreachelse}
            <td>-</td>
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