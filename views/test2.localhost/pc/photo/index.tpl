{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl" add_css="image.css" add_js="image.js"}
{include file="`$smarty.const.PATH_VIEWS`/common/menu.parts.tpl"}

<div class="layout-3-column-center left">
{if !$user}
  <div id="myphoto">
  </div>

{else}{* $user *}
  <div id="myphoto" class="center">
    <form action="/photo/post" method="post" enctype="multipart/form-data">
      <div id="image-post">
        <ul id="images" class="none-list" data-list-mode="0" data-list-size="1" data-list-cols="1">
        </ul><!-- #images -->
      </div><!-- #image-post" -->
      <input type="text" name="title" value="{$title}" />
      <input type="submit" value="登録" />
    </form>
    <ul class="layout-3-column">
{foreach from=$myphotos item=item}
      <li><a href="/photo/{$item.image}">
        <img src="{$item.image}" alt="{$item.name}" />
      </a></li>
{/foreach}
    </ul>
  </div>

  <div id="friends-photo">
    <ul class="layout-3-column">
{foreach from=$friendphotos item=item}
      <li><a href="/photo/{$item.image}">
        <img src="{$item.image}" alt="{$item.name}" />
      </a></li>
{foreachelse}
      <li>
      </li>
{/foreach}
    </ul>
  </div>

  <div id="group-photo">
    <ul class="layout-3-column">
{foreach from=$groupphotos item=item}
      <li><a href="/photo/{$item.image}">
        <img src="{$item.image}" alt="{$item.name}" />
      </a></li>
{foreachelse}
      <li>
      </li>
{/foreach}
    </ul>
  </div>
{/if}

  <div id="latest-photo">
    <ul class="layout-3-column">
      <li><a href="/account/login?r={$smarty.server.REQUEST_URI|urlencode}">
        <img src="/image/photo/sample/sample1.jpg" alt="サンプル画像1" />
      </a></li>
      <li><a href="/account/login?r={$smarty.server.REQUEST_URI|urlencode}">
        <img src="/image/photo/sample/sample1.jpg" alt="サンプル画像1" />
      </a></li>
      <li><a href="/account/login?r={$smarty.server.REQUEST_URI|urlencode}">
        <img src="/image/photo/sample/sample2.jpg" alt="サンプル画像2" />
      </a></li>
      <li><a href="/account/login?r={$smarty.server.REQUEST_URI|urlencode}">
        <img src="/image/photo/sample/sample3.jpg" alt="サンプル画像3" />
      </a></li>
{foreach from=$latest item=item}
      <li><a href="/photo/{$item.image}">
        <img src="{$item.image}" alt="{$item.name}" />
      </a></li>
{foreachelse}
      <li>
      </li>
{/foreach}
    </ul>
  </div><!-- #latest-photo -->
</div><!-- .layout-3-column-center-->

{include file="`$smarty.const.PATH_VIEWS`/common/menu.parts.tpl"}

{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
