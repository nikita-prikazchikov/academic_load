{$this->doctype()}
<html>
<head>
{$this->headTitle()}
{$this->headLink()}
{$this->headScript()}
</head>
<body>
{include file="header.tpl"}
<div class="container-fluid">
    {$this->layout()->content}
</div>
<div id="modal" class="modal hide fade in"></div>
</body>
</html>