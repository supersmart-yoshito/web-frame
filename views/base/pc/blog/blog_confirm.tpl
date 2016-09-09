{include file="`$smarty.const.TEMPLATE_DIR`/common/header.tpl"}


<form action="" method="post">

<p>{$name}</p>
<table>
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

{if $isOpened}
<input type="submit" value="{$lang->convert('変更する')}" />
{else}
<input type="submit" value="{$lang->convert('開設する')}" />
{/if}
<input type="hidden" name="confirm" value="1" />
<input type="hidden" name="name" value="{$name}" />
<input type="hidden" name="publish" value="{$publish}" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>
<form action="" method="post">
<input type="submit" value="{$lang->convert('キャンセル')}" />
<input type="hidden" name="cancel" value="1" />
<input type="hidden" name="name" value="{$name}" />
<input type="hidden" name="publish" value="{$publish}" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>

{include file="`$smarty.const.TEMPLATE_DIR`/common/footer.tpl"}
