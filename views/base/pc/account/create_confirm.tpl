
{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}


<p>confirm</p>
<form action="/account/create/complete" method="post">
<table>
<tr><th>ログインID</th><td><span>{$user_id}</span></td></tr>
<tr><th>パスワード</th><td><span>{$user_pass}</span></td></tr>
</table>
<input type="submit" value="登録する" />
<input type="hidden" name="user_id" value="{$user_id}" />
<input type="hidden" name="user_pass" value="{$user_pass}" />
<input type="hidden" name="confirm" value="1" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>


{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
