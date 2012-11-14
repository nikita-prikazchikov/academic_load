<div class="modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Добавить/редактировать специальность</h3>
    </div>
    <div class="modal-body">
        <div class="form-horizontal row-fluid">
            <input class="hidden" id="edit-speciality-id" value="{$speciality->getId()}">
            <fieldset>
                <div class="control-group">
                    <label class="control-label">Имя специальности</label>

                    <div class="controls">
                        <input class="text span12" id="edit-speciality-name" value="{$speciality->getName()}"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Имя специальности</label>

                    <div class="controls">
                        <select class="span12" id="edit-speciality-type">
                            <option {if $speciality->getType()== "dairy"}selected{/if} value="diary">Дневники</option>
                            <option {if $speciality->getType()== "extramural"}selected{/if} value="extramural">Заочники</option>
                            <option {if $speciality->getType()== "evening"}selected{/if} value="evening">Вечерники</option>
                        </select>
                    </div>
                </div>
            </fieldset>
        </div>
        <div id="modal_alert" class="alert alert-error fade in" style="display: none"></div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary btn-speciality-submit"><i class="icon-ok icon-white"></i> Сохранить</a>
        <a href="#" class="btn" data-dismiss="modal"><i class="icon-ban-circle"></i> Отмена</a>
    </div>
</div>
<script type="text/javascript">pages.speciality.dialog.init();</script>
