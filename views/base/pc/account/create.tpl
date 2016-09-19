{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}


{if $error}
<p>error</p>
{/if}

<form action="/account/create/confirm" method="post">
<table>
<tr><td><input type="text" name="user_id" value="{$user_id}" placeholder="ログインID"/></td></tr>
<tr><td><input type="text" name="user_pass" value="{$user_pass}" placeholder="パスワード"/></td></tr>
</table>
<input type="submit" value="確認する" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>


{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
