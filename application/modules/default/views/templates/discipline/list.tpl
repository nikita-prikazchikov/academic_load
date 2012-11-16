<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr class="">
        <th class="">Имя</th>
        <th class="">Действия</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$disciplineList->getList() item=discipline}
    <tr>
        <td>{$discipline->getName()}</td>
        <td>
            <div class="btn btn-mini btn-discipline-edit" data-id="{$discipline->getId()}">
                <i class="icon-pencil"></i></div>
        </td>
    </tr>
        {foreachelse}
    <div class="alert alert-info">Нет дисциплин для отображения</div>
    {/foreach}
    </tbody>
</table>
<script type="text/javascript">pages.discipline.list.init();</script>