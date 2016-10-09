{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}

<div class="layout-3-column-left left">
<p>test</p>
</div> <!-- div.layout-3-column-left -->

<div class="layout-3-column-center left center">
<form action="/account/create/confirm" method="post" class="clearfix">
<table class="w100p">
<tr><th class="w100">ログインID</th><td><input class="fs12" pattern="^[0-9A-Za-z]+$" type="text" name="user_id" value="{$params.user_id}" />{if $error.user_id}<p class="warn">{$error.user_id}</p>{/if}</td></tr>
<tr><th class="w100">パスワード</th><td><input class="fs12" pattern="^[0-9A-Za-z]+$" type="text" name="user_pass" value="{$params.user_pass}" />{if $error.user_id}<p class="warn">{$error.password}</p>{/if}</td></tr>
<tr><th class="w100">ニックネーム</th><td><input class="fs12" type="text" name="user_nickname" value="{$params.user_nickname}" />{if $error.user_id}<p class="warn">{$error.nickname}</p>{/if}</td></tr>
<tr><th class="w100">誕生日</th><td>{include file="`$smarty.const.PATH_ROOT`/views/base/common/birthdate.parts.tpl"}</td></tr>
<tr><th class="w100">性別</th><td>{include file="`$smarty.const.PATH_ROOT`/views/base/common/sex.parts.tpl"}</td></tr>
<tr><th class="w100">都道府県</th><td>{include file="`$smarty.const.PATH_ROOT`/views/base/common/prefectures.parts.tpl"}</td></tr>
<tr><th class="w100">プロフィール</th><td><textarea name="profile" class="w80p fs12" rows="10">{$params.profile}</textarea></td></tr>
</table>
<input type="submit" value="確認する" />
<input type="hidden" name="__time" value="{$__time}" />
<input type="hidden" name="__token" value="{$__token}" />
</form>
</div> <!-- div.layout-3-column-center -->

<div class="layout-3-column-right left">
<p>test</p>
</div> <!-- div.layout-3-column-left -->

{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
