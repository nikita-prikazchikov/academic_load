<table class="table table-striped table-condensed">
    <thead>
    <tr class="">
        <th class="">Пользователь</th>
        <th class="">Ставка</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$userList->getList() item=user}
    <tr>
        <td>{$user->getName()}</td>
        <td>
            <select data-id="{$user->getRate($yearId)->getId()}" class="span12 btn-user-rate-change">
                {html_options options=$filter->getRateList() selected=$user->getRate($yearId)->getRate()}
            </select>
        </td>
    </tr>
        {foreachelse}
    <div class="alert alert-info">Нет пользователей для отображения</div>
    {/foreach}
    </tbody>
</table>
<script type="text/javascript">pages.rate.list.init();</script>