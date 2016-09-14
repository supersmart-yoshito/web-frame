{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl" add_css="image.css,lightbox.css" add_js="image.js"}
{include file="`$smarty.const.PATH_VIEWS`/common/menu.parts.tpl"}

<div class="layout-3-column-center left">
  <div id="userphoto" class="h200 mb50 clearfix">
    <h4 class="ctxt m0 p0">友人の写真</h4>
{foreach from=$friends item=friend}
    <ul class="layout-3-column">
{foreach from=$friendphotos[$friend->getFriendId()] item=item}
      <li><a href="/photo/image/{$item->id}" rel="lightbox" title="{$item->title}">
        <img src="/photo/image/{$item->id}" alt="{$item->title}" />
      </a></li>
{/foreach}
    </ul>
{if file_exists("`$smarty.const.PATH_ROOT`/views/base/common/pager.tpl")}
{include file="`$smarty.const.PATH_ROOT`/views/base/common/pager.tpl"}
{/if}
{/foreach}
  </div>
</div><!-- .layout-3-column-center-->

{include file="`$smarty.const.PATH_VIEWS`/common/menu.parts.tpl"}

<script src="/js/lightbox.js"></script>
{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
