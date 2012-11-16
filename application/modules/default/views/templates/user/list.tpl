<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr class="">
        <th class="">Имя</th>
        <th class="">Действия</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$userList->getList() item=user}
    <tr>
        <td>{$user->getName()}</td>
        <td>
            <div class="btn btn-mini btn-user-edit" data-id="{$user->getId()}">
                <i class="icon-pencil"></i></div>
        </td>
    </tr>
        {foreachelse}
    <div class="alert alert-info">Нет пользователей для отображения</div>
    {/foreach}
    </tbody>
</table>
<script type="text/javascript">pages.user.list.init();</script>