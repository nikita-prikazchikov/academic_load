<div class="modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Диалог выбора периода</h3>
    </div>
    <div class="modal-body">
        <div class="form-horizontal row-fluid">
            <fieldset>
                <div class="control-group">
                    <label class="control-label">Год</label>

                    <div class="controls">
                        <select class="span12" name="year">
                        {html_options options=$yearList selected=$yearCurrent}
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Семестр</label>

                    <div class="controls">
                        <select name="semester" class="span12">
                        {html_options options=$filter->getSemesterAll()}
                        </select>
                    </div>
                </div>
        </div>
        <div id="modal_alert" class="alert alert-error fade in" style="display: none"></div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary btn-period-submit"><i class="icon-ok icon-white"></i> Сохранить</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="icon-ban-circle"></i> Отмена</a>
    </div>
</div>
<script type="text/javascript">period.dialog.init();</script>
