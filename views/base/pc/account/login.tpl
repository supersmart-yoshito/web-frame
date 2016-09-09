{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}


{if $error}
<p>error</p>
{/if}

<form action="/account/login" method="post">
<dl>
<dd><input type="text" name="user_id" value="{$user_id}" placeholder="ログインID" /></dd>
<dd><input type="text" name="user_pass" value="{$user_pass}" placeholder="パスワード" /></dd>
</dl>
<p><input type="submit" value="ログイン" /></p>
<ul>
<li><a href="/account/create">無料会員登録</a></li>
<li><a href="/account/reminder">パスワードを忘れた方はこちら</li>
</ul>
{if $r}
<input type="hidden" name="r" value="{$r}" />
{/if}
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>


{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
