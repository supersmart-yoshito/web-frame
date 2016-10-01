{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl" add_css="" add_js=""}
{include file="`$smarty.const.PATH_VIEWS`/common/menu.parts.tpl"}

<div class="layout-3-column-center h100p">
<ul class="none-list">
{foreach from=$activities item=activity}
  <li><a href="/account/mypage/{$activity->getAccountId()}">
  </a></li>
{foreachelse}
  <li><div class="center">
    <p>さあ知り合いを探して、友達になろう。</p>
    <p><a href="/friend/search">友達を検索する</a></p>
    {include file="`$smarty.const.PATH_ROOT`/views/base/pc/parts/social.parts.tpl"}
  </div></li>
{/foreach}
</ul>
</div><!-- .layout-3-column-center-->

{include file="`$smarty.const.PATH_ROOT`/views/base/pc/parts/profile.parts.tpl"}
{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
