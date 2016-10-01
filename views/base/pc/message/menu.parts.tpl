<div class="layout-1-column">
<ul class="menu">
<li><a href="/message/editbox/edit/0" class="btn">メッセージを作成</a></li>
{if $enableOperation}
<li><a href="#" class="btn">全て選択</a></li>
<li><a href="#" class="btn" disabled>削除</a></li>
{/if}
{if $enableReply && $message}
<li><a href="/message/editbox/edit/{$message->getId()}" class="btn">返信</a></li>
{/if}
{if $enableSend}
<li><input type="submit"value="送信" class="btn" /></li>
{/if}
<li>最初のページ</li>
<li>最後のページ</li>
</ul>
</div>

<div class="layout-3-column-left left">
<ul class="none-list">
<li><a href="/message/inbox">受信トレイ{if $unreadCount}({$unreadCount}){/if}</a></li>
<li><a href="/message/outbox">送信トレイ</a></li>
<li><a href="/message/editbox">編集トレイ{if $editCount}({$editCount}){/if}</a></li>
<li><a href="/message/trash">ゴミ箱</a></li>
<li><a href=""></a></li>
</ul>
</div>{*<!-- .layout-3-column-left left -->*}
