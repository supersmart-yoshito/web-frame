{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}



<ul>
{foreach from=$list item=item}
<li>{$item->getSessionId()}</li>
{/foreach}
</ul>



{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
