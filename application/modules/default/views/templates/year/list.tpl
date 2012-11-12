<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr class="">
        <th class="">Id</th>
        <th class="">Имя</th>
        <th class="">Действия</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$yearList->getList() item=year}
    <tr>
        <td>{$year->getId()}</td>
        <td>{$year->getName()}</td>
        <td></td>
    </tr>
    {foreachelse}
    <div class="alert alert-info">There is no years</div>
    {/foreach}
    </tbody>
</table>
<script type="text/javascript">pages.year.list.init();</script>