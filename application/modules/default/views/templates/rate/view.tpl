<div class="btn-toolbar">
    <div class="btn-group">
        <div class="btn btn-primary btn-user-rate-back" data-year-id="{$yearId}"><i class="icon-arrow-left icon-white"></i> Назад</div>
    </div>
</div>
<div class="row-fluid">
    <div id="view_alert" class="alert alert-error fade in" style="display: none"></div>
</div>
<div class="row-fluid rate-list-container">
    {include "../rate/list.tpl"}
</div>
<script type="text/javascript">pages.rate.view.init();</script>
