{include file="`$smarty.const.PATH_VIEWS`/common/header.tpl" pageTitle=$smarty.const.SITE_NAME add_css="slider.css" add_js="image_slider.js,tabs.js,clip_post.js,accordion.js"}

<section>
<div id="keyvisual">
<img src="/data/common/top/ccc106.jpg" />
<img src="/data/common/top/aaa102.jpg" />
<img src="/data/common/top/aaa100.jpg" />
<img src="/data/common/top/aaa109.jpg" />
<img src="/data/common/top/aaa107.jpg" />
<img src="/data/common/top/ccc110.jpg" />
<img src="/data/common/top/www105.jpg" />
<img src="/data/common/top/www108.jpg" />
</div><!-- .fade_slider -->
<p id="catchcopy">きっと見つかるあなたのクリップ</p>
<form id="search" action="" method="post">
<input type="text" name="keyword" value="" placeholder="イベント名やキーワードなど"/>
<input type="submit" value="検索" />
</form>
</section>

{*
<div class="image_slider">
<div><img width="100%" src="/data/common/top/ccc106.jpg" /></div>
<div><img width="100%" src="/data/common/top/aaa102.jpg" /></div>
<div><img width="100%" src="/data/common/top/aaa101.jpg" /></div>
</div><!-- .image_slider -->
*}



<section class="clearfix">
<!-- タブ -->
<div class="tab">
<ul class="tab-list">
  <li><a href="#news">News</a></li>
  <li><a href="#event-clips">Event</a></li>
  <li><a href="#share-clips">Share</a></li>
  <li><a href="#my-clips">My</a></li>
  <li><a href="#timeline-clips">Timeline</a></li>
</ul>

<!-- 最新ニュース -->
<ul id="news" class="item-list none-list clearfix">
  <li><a href="">
  <div class="list-thumbnail"><img src="http://placehold.jp/c0c0c0/000000/50x50.png" /></div>
  <div class="list-content">
    <span class="category red">カテゴリ</span>
    <h2 class="title">記事タイトルああああああああああああああああああああああああああああああああああああああああああ</h2>
    <p class="date">2015.10.10</p>
  </div><!-- div.list-content -->
  </a></li>
  <li><a href="">
  <div class="list-thumbnail"><img src="http://placehold.jp/c0c0c0/000000/50x50.png" /></div>
  <div class="list-content">
    <span class="category red">カテゴリ</span>
    <h2 class="title">記事タイトル</h2>
    <p class="date">2015.10.10</p>
  </div><!-- div.list-content -->
  </a></li>
  <li><a href="">
  <div class="list-thumbnail"><img src="http://placehold.jp/c0c0c0/000000/50x50.png" /></div>
  <div class="list-content">
    <span class="category red">カテゴリ</span>
    <h2 class="title">記事タイトル</h2>
    <p class="date">2015.10.10</p>
  </div><!-- div.list-content -->
  </a></li>
  <li><a href="">
  <div class="list-thumbnail"><img src="http://placehold.jp/c0c0c0/000000/50x50.png" /></div>
  <div class="list-content">
    <span class="category red">カテゴリ</span>
    <h2 class="title">記事タイトル</h2>
    <p class="date">2015.10.10</p>
  </div><!-- div.list-content -->
  </a></li>
  <li><a href="">
    <p>More</p>
  </a></li>
</ul>

<!-- イベント -->
<ul id="event-clips" class="event-list none-list">
  <li><a href="/event/open">イベントを作成</a></li>
  <li><a href="">
  <div class="event-thumbnail"><img src="http://placehold.jp/c0c0c0/000000/50x50.png" /></div>
  <div class="event-content">
    <span class="category red clearfix">カテゴリ</span>
    <h2 class="event-title">イベントタイトル</h2>
    <p class="event-date">日程：2015.10.10 18:00 - 24:00</p>
    <p class="event-place">場所：東京都渋谷区１０９</p>
  </div><!-- div.event-content -->
  </a></li>
  <li><a href="">
  <div class="event-thumbnail"><img src="http://placehold.jp/c0c0c0/000000/50x50.png" /></div>
  <div class="event-content">
    <span class="category red">カテゴリ</span>
    <h2 class="event-title">イベントタイトル</h2>
    <p class="event-place">場所：東京都渋谷区１０９</p>
    <p class="event-date">日程：2015.10.10 18:00 - 24:00</p>
  </div><!-- div.event-content -->
  </a></li>
  <li><a href="">
  <div class="event-thumbnail"><img src="http://placehold.jp/c0c0c0/000000/50x50.png" /></div>
  <div class="event-content">
    <span class="category red">カテゴリ</span>
    <h2 class="event-title">イベントタイトル</h2>
    <p class="event-place">場所：東京都渋谷区１０９</p>
    <p class="event-date">日程：2015.10.10 18:00 - 24:00</p>
  </div><!-- div.event-content -->
  </a></li>
  <li><a href="">
    <p>More</p>
  </a></li>
</ul>

<!-- 共有クリップ -->
<ul id="share-clips" class="item-list none-list">
  <li><a href="">
  <div class="list-thumbnail"><img src="http://placehold.jp/c0c0c0/000000/50x50.png" /></div>
  <div class="list-content">
    <span class="category red">カテゴリ</span>
    <h2 class="title">記事タイトル</h2>
    <p class="date">2015.10.10</p>
  </div><!-- div.list-content -->
  </a></li>
  <li><a href="">
  <div class="list-thumbnail"><img src="http://placehold.jp/c0c0c0/000000/50x50.png" /></div>
  <div class="list-content">
    <span class="category red">カテゴリ</span>
    <h2 class="title">記事タイトル</h2>
    <p class="date">2015.10.10</p>
  </div><!-- div.list-content -->
  </a></li>
  <li><a href="">
  <div class="list-thumbnail"><img src="http://placehold.jp/c0c0c0/000000/50x50.png" /></div>
  <div class="list-content">
    <span class="category red">カテゴリ</span>
    <h2 class="title">記事タイトル</h2>
    <p class="date">2015.10.10</p>
  </div><!-- div.list-content -->
  </a></li>
  <li><a href="">
  <div class="list-thumbnail"><img src="http://placehold.jp/c0c0c0/000000/50x50.png" /></div>
  <div class="list-content">
    <span class="category red">カテゴリ</span>
    <h2 class="title">記事タイトル</h2>
    <p class="date">2015.10.10</p>
  </div><!-- div.list-content -->
  </a></li>
  <li><a href="">
    <p>More</p>
  </a></li>
</ul>


<script>
{literal}
$(function () {

	function getItem() {
		var item = '' + 
		'<li><div>' +
		'<input type="file" name="dummy" />' + 
		'<img class="clip-image" src="http://placehold.jp/50x50png?text=＋" />' + 
		'<img class="clip-cancel" src="/image/close_red.gif" />' + 
		'</div></li>' ;

		return item ;
	}


	$(document).on('click', 'img.clip-image', function () {
		$(this).prev().click() ;
		return false ;
	}) ;

	$(document).on('click', 'img.clip-cancel', function () {

		// 該当画像の削除
		var removeObj = $(this).parent().parent().remove() ;
		removeObj.empty() ;

		// 画像送信用のキーを振り直し
		$('ul#clip-images li').each(function(index) {

			// 画像選択用のダミー画像は除外
			var item = $(this).children().children('input[type=file]') ;
			if(item.attr('name') !== 'dummy') {
				item.attr('name', 'clip['+index+']') ;
			}
		}) ;

		// 画像選択用のダミー画像数取得
		var dummyCount = $('ul#clip-images li div input[name=dummy]').length ;
		if (dummyCount == 0) {
			$('ul#clip-images').append(getItem()) ;
		}
		return false ;
	}) ;

	$(document).on('change', 'ul#clip-images li div input[type=file]', function (){

		// ファイルオブジェクト取得
		var file = $(this).prop('files')[0];

		// 画像以外は処理を停止
		if (!file.type.match('image.*')) {
			return;
		}

		// 画像表示
		var reader = new FileReader();
		var obj = $(this) ;
		reader.onload = function() {
			var img_src = obj.next().attr('src', reader.result);

		}
		reader.readAsDataURL(file);

		// 画像送信用のキーの振り直し前にキー名取得
		var name = $(this).attr('name') ;
		// 画像送信用のキーを振り直し
		$('ul#clip-images li').each(function(index) {

			// 画像が設定されているものは振り直し
			var item = $(this).children().children('input[type=file]') ;
			if (item.prop('files')[0]) {
				item.attr('name', 'clip['+index+']') ;
			}
		}) ;

		var itemCount = $('ul#clip-images li').length ;
		if (itemCount < 4 && name == 'dummy') {
			$('ul#clip-images').append(getItem()) ;
		}

		$(this).next().next().css('top', $(this).next().position().top) ;
		$(this).next().next().css('left', $(this).next().position().left) ;
		$(this).next().next().css('display', 'block') ;
	}) ;

	$(document).on('click', '#clip-form > a', function() {
		$(this).parent().submit() ;
		return false ;
	}) ;
}) ;
{/literal}
</script>



<!-- 自分クリップ -->
<ul id="my-clips" class="clip-list none-list">
{if $user}
  <li>
  <a class="accordion" href="#">＋</a>
  <div id="clip-post">
    <form id="clip-form" action="/clip/post" method="post" enctype="multipart/form-data">
    <div id="clip-type">
    <select name="type">
    <option value="1" selected>{$lang->convert('Photo')}</option>
    <option value="2">{$lang->convert('Voice')}</option>
    </select>
    <select name="category">
    <option value="1" selected>category</option>
    </select>
    </div><!-- div#clip-type -->

    <div id="clip-image-part">
      <div id="clip-title">
        <input type="text" name="title" value="{$title}" placeholder="タイトル" />
      </div><!-- div#clip-title -->
      <ul id="clip-images" class="none-list">
        <li><div>
        <input type="file" name="dummy" />
        <img class="clip-image" src="http://placehold.jp/50x50png?text=＋" />
	<img class="clip-cancel" src="/image/close_red.gif" />
        </div></li>
      </ul>
      <div class="clearfix"></div>
    </div><!-- div#clip-image-part -->

    <div id="clip-murmur-part" class="" style="display: none;">
    </div><!-- clip-murmur-part -->

    <select name="publish">
    <option value="1" selected>{$lang->convert('全体に公開')}</option>
    <option value="2">{$lang->convert('友達に公開')}</option>
    <option value="3">{$lang->convert('ブループに公開')}</option>
    <option value="4">{$lang->convert('非公開')}</option>
    </select>
    <input type="submit" value="クリップを追加" class="button" />
    <input type="hidden" name="__time" value="{$__time}" />
    <input type="hidden" name="__token" value="{$__token}" />
    </form>
  </div><!-- div#clip-post -->
  </li>

  {foreach from=$myclips item=myclip}
  <li><a href="/clip/clip/{$myclip->getId()}">
  <div class="clip-label">
    {if $myclip->getType() == ClipsModel::CLIP_TYPE_IMAGES}
    <span class="category red">Photo</span><br/>
    {elseif $myclip->getType()}
    {elseif $myclip->getType()}
    {/if}
    <img class="member-icon" src="http://placehold.jp/50x50png?text=test" />
    <p class="balloon-left">{$myclip->getTitle()}</p>
  </div><!-- div.clip-label -->
  <div class="clip-content">
    <img src="/clip/imageapi/{$myclip->image_id}" />
    <p class="date">{$myclip->getCreated()|date_format:'%Y.%m.%d %H:%I'}</p>
  </div><!-- div.clip-content -->
  </a></li>
  {foreachelse}
  {/foreach}
  <li><a href="/clip/list/">More</a></li>
{else}
  <li><a href="">
  Myクリップを利用する
  </a></li>
{/if}
</ul>

<!-- 友達クリップ -->
<ul id="timeline-clips" class="clip-list none-list">
{if $user}
  {if !$user->friends}
  <li><a href="">
  友達にクリップを紹介する
  </a></li>
  {else}
  {if true}
  <li><a href="">
  <div class="clip-label">
    <span class="category red">カテゴリ</span><br/>
    <img class="member-icon" src="http://placehold.jp/50x50png?text=test" />
    <p class="balloon-left">記事タイトル</p>
  </div><!-- div.clip-label -->
  <div class="clip-content">
    <img src="http://placehold.jp/c0c0c0/000000/800x600.png?text=test" />
    <p class="date">2015.10.10 18:00</p>
  </div><!-- div.clip-content -->
  </a></li>
  <li><a href="">
  <div class="clip-label">
    <span class="category red">カテゴリ</span><br/>
    <img class="member-icon" src="http://placehold.jp/50x50png?text=test" />
    <p class="balloon-left">記事タイトル</p>
  </div><!-- div.clip-label -->
  <div class="clip-content">
    <img src="http://placehold.jp/c0c0c0/000000/400x300.png?text=test" />
    <p class="date">2015.10.10 18:00</p>
  </div><!-- div.clip-content -->
  </a></li>
  {/if}
  <li><a href="">
    <p>More</p>
  </a></li>
  {/if}
{else}
  <li><a href="">
  Myクリップを利用する
  </a></li>
{/if}
</ul>
</div>
<section>

<!-- メニュー -->
{*
<section class="clearfix">
<ul class="none-list menu-2-columns">
<li><a href="/"><img src="http://placehold.jp/c0c000/000000/200x100.png?text=media" /></a></li>
<li><a href="/"><img src="http://placehold.jp/00c0c0/000000/200x100.png?text=my" /></a></li>
<li><a href="/"><img src="http://placehold.jp/c000c0/000000/200x100.png?text=friend" /></a></li>
<li><a href="/"><img src="http://placehold.jp/c0c0c0/000000/200x100.png?text=group" /></a></li>
</ul>
</section>
*}




{include file="`$smarty.const.PATH_VIEWS`/common/footer.tpl"}
