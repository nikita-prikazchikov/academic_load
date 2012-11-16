<div class="modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Добавить/редактировать дисциплину</h3>
    </div>
    <div class="modal-body">
        <div class="form row-fluid">
            <input class="hidden" id="edit-discipline-id" value="{$discipline->getId()}">
            <fieldset>
                <div class="control-group">
                    <label class="control-label">Имя Дисциплины</label>

                    <div class="controls">
                        <input class="text span12" id="edit-discipline-name" value="{$discipline->getName()}"/>
                    </div>
                </div>
            </fieldset>
        </div>
        <div id="modal_alert" class="alert alert-error fade in" style="display: none"></div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary btn-discipline-submit"><i class="icon-ok icon-white"></i> Сохранить</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="icon-ban-circle"></i> Отмена</a>
    </div>
</div>
<script type="text/javascript">pages.discipline.dialog.init();</script>
