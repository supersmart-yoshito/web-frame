{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}


<form action="" method="post">

<table>
<tr><th>{$lang->convert('タイトル')}</th><td><input type="text" name="title" value="{$title}" /></td></tr>
<tr><th>{$lang->convert('記事')}</th><td><textarea name="body">{$body}</textarea></td></tr>
<tr><th>{$lang->convert('公開設定')}</th>
<td>
<input type="radio" name="publish" value="1" {if empty($publish)}checked{/if}/>{$lang->convert('全体に公開')}
<input type="radio" name="publish" value="2" {if $publish === 1}checked{/if}/>{$lang->convert('友達に公開')}
<input type="radio" name="publish" value="3" {if $publish === 2}checked{/if}/>{$lang->convert('ブループに公開')}
<input type="radio" name="publish" value="4" {if $publish === 3}checked{/if}/>{$lang->convert('非公開')}
</td></tr>
</table>

<input type="submit" value="{$lang->convert('確認する')}" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>

{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
