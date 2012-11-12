<div class="navbar navbar-static-top">
    <div class="navbar-inner">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <input type="hidden" name="yearId" id="yearId" value="{$yearId}"/>
        <input type="hidden" name="Semester" id="semester" value="{$semester}"/>

        <div class="nav-collapse">
            <ul id="headerMainNav" class="nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Нагрузка
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        ...
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Исходные данные
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <a href="{$this->url(['controller' => 'speciality', 'action' => 'index'])}">
                            <i class="icon-th-large"></i> Специальности
                        </a>
                        <a href="{$this->url(['controller' => 'group', 'action' => 'index'])}">
                            <i class="icon-th-large"></i> Группы
                        </a>
                        <a id="link-user-list" href="{$this->url(['controller' => 'year', 'action' => 'index'])}">
                            <i class="icon-th-large"></i> Годы
                        </a>
                    </ul>
                </li>

                <li class="divider-vertical"></li>

                <li>
                    <a class="brand" href="#">
                    {if isset($yearName)}Учебный год {$yearName}{/if}
                    {if isset($semester) && !empty($semester)} :: Семестр {$semester}{/if}
                    </a>
                </li>
                <li class="btn btn-show-dialog-period-change">Изменить период</li>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">header.init();</script>

