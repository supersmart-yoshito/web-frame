{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}

<ul>
<li><a href="/blog">top</a></li>
<li></li>
</ul>
<p>{$article->getTitle()}</p>
<p>{$article->getBody()}</p>



<form action="" method="post">

<table>
<tr><th>{$lang->convert('名前')}</th><td><input type="text" name="name" value="{$name}" /></td></tr>
<tr><th>{$lang->convert('コメント')}</th><td><textarea name="body">{$body}</textarea></td></tr>
</table>

<ul>
{foreach from=$comments item=comment}
<li>
<p>{$comment->getName()}</p>
<p>{$comment->getBody()}</p>
<p>{$comment->getCreated()}</p>
</li>
{foreachelse}
<li></li>
{/foreach}
</ul>

<input type="submit" value="{$lang->convert('コメントする')}" />
<input type="hidden" name="comment" value="1" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>



{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
