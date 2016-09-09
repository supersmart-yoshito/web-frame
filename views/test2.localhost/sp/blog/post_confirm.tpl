{include file="`$smarty.const.PATH_VIEWS`/common/header.tpl"}


<form action="" method="post">

<table>
<tr><th>{$lang->convert('タイトル')}</th><td>
{$title}
</td></tr>
<tr><th>{$lang->convert('記事')}</th><td>
{$body}
</td></tr>
<tr><th>{$lang->convert('公開設定')}</th></tr>
<tr><td>
{if $publish == 1}
{$lang->convert('全体に公開')}
{elseif $publish == 2}
{$lang->convert('友達に公開')}
{elseif $publish == 3}
{$lang->convert('ブループに公開')}
{else}
{$lang->convert('非公開')}
{/if}
</td></tr>
</table>

<input type="submit" value="{$lang->convert('投稿する')}" />
<input type="hidden" name="confirm" value="1" />
<input type="hidden" name="title" value="{$title}" />
<input type="hidden" name="publish" value="{$publish}" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
<textarea name="body" style="display: none;">{$body}</textarea>
</form>
<form action="" method="post">
<input type="submit" value="{$lang->convert('キャンセル')}" />
<input type="hidden" name="cancel" value="1" />
<input type="hidden" name="title" value="{$title}" />
<input type="hidden" name="publish" value="{$publish}" />
<input type="hidden" name="confirm" value="1" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
<textarea name="body" style="display: none;">{$body}</textarea>
</form>

{include file="`$smarty.const.PATH_VIEWS`/common/footer.tpl"}
