<div class="modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Добавить/редактировать группу</h3>
    </div>
    <div class="modal-body">
        <div class="form-horizontal row-fluid">
            <input class="hidden" id="edit-group-id" value="{$group->getId()}">
            <input class="hidden" id="edit-speciality-id" value="{$group->getIdSpecialityFk()|default:$id_speciality}">
            <fieldset>
                <div class="control-group">
                    <label class="control-label">Имя группы</label>

                    <div class="controls">
                        <input class="text span12" id="edit-group-name" value="{$group->getName()}"/>
                    </div>
                </div>
            </fieldset>
        </div>
        <div id="modal_alert" class="alert alert-error fade in" style="display: none"></div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary btn-group-submit"><i class="icon-ok icon-white"></i> Сохранить</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="icon-ban-circle"></i> Отмена</a>
    </div>
</div>
<script type="text/javascript">pages.group.dialog.init();</script>
