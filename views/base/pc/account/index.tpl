{include file="`$smarty.const.PATH_VIEWS`/common/header.tpl"}

{$lang->convert('index')}
<ul>
{if $user}
<li><a href="/user/logout">{$lang->convert('ログアウト')}</a></li>
<li><a href="/user/leave/{$user->getId()}">{$lang->convert('退会')}</a></li>
{else}
<li><a href="/user/login">{$lang->convert('ログイン')}</a></li>
<li><a href="/user/join">{$lang->convert('登録')}</a></li>
{/if}
</ul>

{include file="`$smarty.const.PATH_VIEWS`/common/footer.tpl"}
