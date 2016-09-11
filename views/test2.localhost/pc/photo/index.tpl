{include file="`$smarty.const.PATH_ROOT`/views/base/common/header.tpl" add_css="image.css,lightbox.css" add_js="image.js"}
{include file="`$smarty.const.PATH_VIEWS`/common/menu.parts.tpl"}

<div class="layout-3-column-center left">
{if !$user}
  <div id="myphoto" class="h200">
    <h4 class="ctxt m0 p0">マイフォト</h4>
    <a href="/account/login?r={$smarty.server.REQUEST_URI}"><p>ログインして利用する</p></a>
  </div>

{else}{* $user *}
  <div id="post" class="h200">
    <p>さあ写真を公開して、みんなと共有しよう。</p>
{if $error}
    <p>{$error}</p>
{/if}
    <form action="/photo/post" method="post" enctype="multipart/form-data">
      <ul class="none-list">
        <li class="clearfix">
          <input type="text" name="title" value="{$title}" maxlength="32" placeholder="タイトル"/>
          <select name="publish">
          <option value="1" selected>全体に公開</option>
          <option value="2">グループに公開</option>
          <option value="3">友達に公開</option>
          <option value="4">非公開</option>
          </select>
          <input type="submit" value="送信" />
        </li>
        <li>
          <input type="file" name="photo" />
        </li>
      </ul>
    </form>
  </div>

  <div id="myphoto" class="h200 clearfix">
    <h4 class="ctxt m0 p0">マイフォト</h4>
    <ul class="layout-3-column">
{foreach from=$myphotos item=item}
      <li><a href="/photo/image/{$item->id}" rel="lightbox" title="{$item->title}">
        <img src="/photo/image/{$item->id}" alt="{$item->title}" />
      </a></li>
{/foreach}
    </ul>
{if $myphotos}
    <p><a href="/photo/my">もっと見る</a></p>
{/if}
  </div>

  <div id="friends-photo" class="clearfix h200">
    <h4 class="ctxt m0 p0">友人の写真</h4>
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
{if $friendphotos}
    <p><a href="/photo/friends">もっと見る</a></p>
{else}
    <p>友人に紹介して、さあ写真を共有しよう。</p>
{/if}
  </div>

  <div id="group-photo" class="h200">
    <h4 class="ctxt m0 p0">グループの写真</h4>
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
{if $groupphotos}
    <p><a href="/photo/group">もっと見る</a></p>
{else}
    <p>グループで写真を共有しよう。</p>
{/if}
  </div>
{/if}

  <div id="latest-photo" class="h200">
    <h4 class="ctxt m0 p0">最新の写真</h4>
    <ul class="layout-3-column">
      <li><a href="/image/photo/sample/sample1.jpg" rel="lightbox" title="サンプル画像1">
        <img src="/image/photo/sample/sample1.jpg" alt="サンプル画像1" />
      </a></li>
      <li><a href="/image/photo/sample/sample1.jpg" rel="lightbox" title="サンプル画像1">
        <img src="/image/photo/sample/sample1.jpg" alt="サンプル画像1" />
      </a></li>
      <li><a href="/image/photo/sample/sample2.jpg" rel="lightbox" title="サンプル画像2">
        <img src="/image/photo/sample/sample2.jpg" alt="サンプル画像2" />
      </a></li>
      <li><a href="/image/photo/sample/sample3.jpg" rel="lightbox" title="サンプル画像3">
        <img src="/image/photo/sample/sample3.jpg" alt="サンプル画像3" />
      </a></li>
      <li><a href="/image/photo/sample/sample3.jpg" rel="lightbox" title="サンプル画像3">
        <img src="/image/photo/sample/sample3.jpg" alt="サンプル画像3" />
      </a></li>
      <li><a href="/image/photo/sample/sample3.jpg" rel="lightbox" title="サンプル画像3">
        <img src="/image/photo/sample/sample3.jpg" alt="サンプル画像3" />
      </a></li>
      <li><a href="/image/photo/sample/sample3.jpg" rel="lightbox" title="サンプル画像3">
        <img src="/image/photo/sample/sample3.jpg" alt="サンプル画像3" />
      </a></li>
      <li><a href="/image/photo/sample/sample3.jpg" rel="lightbox" title="サンプル画像3">
        <img src="/image/photo/sample/sample3.jpg" alt="サンプル画像3" />
      </a></li>
      <li><a href="/image/photo/sample/sample3.jpg" rel="lightbox" title="サンプル画像3">
        <img src="/image/photo/sample/sample3.jpg" alt="サンプル画像3" />
      </a></li>
      <li><a href="/image/photo/sample/sample3.jpg" rel="lightbox" title="サンプル画像3">
        <img src="/image/photo/sample/sample3.jpg" alt="サンプル画像3" />
      </a></li>
      <li><a href="/image/photo/sample/sample3.jpg" rel="lightbox" title="サンプル画像3">
        <img src="/image/photo/sample/sample3.jpg" alt="サンプル画像3" />
      </a></li>
      <li><a href="/image/photo/sample/sample3.jpg" rel="lightbox" title="サンプル画像3">
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

<script src="/js/lightbox.js"></script>
{include file="`$smarty.const.PATH_ROOT`/views/base/common/footer.tpl"}
