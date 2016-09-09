{include file="`$smarty.const.TEMPLATE_DIR`/common/header.tpl"}


{foreach from=$pager->getPages() item=page}
<p><a href="{$page->getLink()}">{$page->getPage()}</a></p>
{/foreach}

<ul>
{foreach from=$articles item=article}
<li><a href="/blog/detail/{$postUser->getId()}/{$article->getId()}">{$article->getTitle()}</a></li>
{foreachelse}
<li>out of service</li>
{/foreach}
</ul>


{include file="`$smarty.const.TEMPLATE_DIR`/common/footer.tpl"}
