
{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl"}


<div class="layout-3-column-left left">
<p>test</p>
</div> <!-- div.layout-3-column-left -->

<div class="layout-3-column-center left">
<div class="w100p">
<h1>ご入力内容の確認</h1>
<form action="/account/create/complete" method="post" class="dib">
<table id="form">
<tr><th class="tit w100">ログインID</th><td class="confirm"><span class="fs12">{$params.user_id|escape}</span></td></tr>
<tr><th class="tit w100">パスワード</th><td class="confirm"><span class="fs12">{$params.user_pass|escape}</span></td></tr>
<tr><th class="tit w100">ニックネーム</th><td class="confirm"><span class="fs12">{$params.user_nickname|escape}</span></td></tr>
<tr><th class="tit w100">誕生日</th><td class="confirm"><span class="fs12">{$params.birth_year|escape}/{$params.birth_month|escape}/{$params.birth_day|escape}</span></td></tr>
<tr><th class="tit w100">性別</th><td class="confirm"><span class="fs12">{if $params.sex|escape == 'm'}男性{elseif $params.sex|escape == 'f'}女性{else}その他{/if}</span></td></tr>
<tr><th class="tit w100">都道府県</th><td class="confirm"><span class="fs12">{$params.prefectures|escape}</span></td></tr>
<tr><th class="tit w100">職業</th><td class="confirm"><span class="fs12">{$params.job|escape}</span></td></tr>
<tr><th class="tit w100">プロフィール</th><td class="confirm"><span class="fs12">{$params.profile|escape|nl2br}</span></td></tr>
</table>
<input type="submit" value="登録する" class="btn" />
<a href="javascript:history.back();" class="btn">キャンセル </a>
<input type="hidden" name="user_id" value="{$params.user_id|escape}" />
<input type="hidden" name="user_pass" value="{$params.user_pass|escape}" />
<input type="hidden" name="user_nickname" value="{$params.user_nickname|escape}" />
<input type="hidden" name="birthday" value="{$params.birth_year|escape}-{$params.birth_month|escape|string_format:"%02d"}-{$params.birth_day|escape|string_format:"%02d"}" />
<input type="hidden" name="sex" value="{$params.sex|escape}" />
<input type="hidden" name="prefectures" value="{$params.prefectures|escape}" />
<input type="hidden" name="job" value="{$params.job|escape}" />
<input type="hidden" name="profile" value="{$params.profile|escape|nl2br}" />
<input type="hidden" name="confirm" value="1" />
<input type="hidden" name="__time" value="{$__time|escape}" />
<input type="hidden" name="__token" value="{$__token|escape}" />
</form>
</div>
</div> <!-- div.layout-3-column-center -->

<div class="layout-3-column-right left">
<p>test</p>
</div> <!-- div.layout-3-column-left -->

{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
