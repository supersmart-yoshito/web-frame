//
// イメージ関連操作
//
//
//
//

$(function() {

	var imageList = $('#image-post').children('#images') ;
	var listSize = imageList.data('listSize') ;
	var colSize = imageList.data('listCols') ;
        if (imageList.data('listMode')) {
	    var listMode = imageList.data('listMode') ;
        } else {
	    var listMode = 0 ;
        }
        if (imageList.data('listRect')) {
	    var length = imageList.data('listRect') ;
        } else {
	    var length = imageList.outerWidth()/colSize-4 ;
        }



	// ロード時に読み込み受け入れイメージフレームを設定
	for (var i = 0; i < listSize; i++) {

		imageList.append(
			'<li data-image-index="'+i+'"><a href="#">'
			+'<img class="cancel" src="/image/common/close_red.gif" />'
			+'<img class="add" src="http://placehold.jp/50x50png?text=＋" />'
			+'<input type="file" name="image-upload['+i+']" />'
			+'</a></li>'
		) ;
		// 逐次追加モード
		if (listMode == 0) {
			break;
		}
	}

	// 各リスト要素の設定
	imageList.children('li').each(function(index, elm) {

		$(elm).children().children('img').css('width', length+'px') ;
		$(elm).children().children('img').css('height', length+'px') ;

		// 指定要素数以上の場合は折り返し
		if (index != 0 && index % colSize == 0) {
			$(elm).addClass('clearfix') ;
		}
	}) ;

	$(document).on('click', '#images > li > a > img.add', function() {
		$(this).next().click() ;
		return false ;
	}) ;

	$(document).on('click', '#images > li > a > img.cancel', function() {

		if (listMode == 1) {

			var input = $(this).next().next().remove() ;
			var name = input.attr('name') ;
			input.empty() ;

			$(this).css('display', 'none') ;
			$(this).next().attr('src', 'http://placehold.jp/50x50png?text=＋');
			$(this).next().after('<input type="file" />')
		} else {

			li = $(this).parent().parent().remove() ;
			li.empty() ;
			if (imageList.children('li').length < listSize) {
				imageList.append(
					'<li><a href="#">'
					+'<img class="cancel" src="/image/common/close_red.gif" />'
					+'<img class="add" src="http://placehold.jp/50x50png?text=＋" />'
					+'<input type="file" />'
					+'</a></li>'
				) ;
				var child = imageList.children('li:last-child') ;
				child.children().children('img.add').css('width', length+'px') ;
				child.children().children('img.add').css('height', length+'px') ;
			}
		}

		// 各リスト要素の設定
		imageList.children('li').each(function(index, elm) {

			// 名前振り直し
			$(elm).attr('data-image-index', index) ;
			$(elm).children().children('input').attr('name', 'image-upload['+index+']') ;
			// 指定要素数以上の場合は折り返し
			if (index != 0 && index % colSize == 0) {
				$(elm).addClass('clearfix') ;
			} else {
				$(elm).removeClass('clearfix') ;
			}
		}) ;

		return false ;
	}) ;

	$(document).on('change', '#image-post > ul#images > li > a > input[type=file]', function(){

		// ファイルオブジェクト取得
		var file = $(this).prop('files')[0];

		// 画像以外は処理を停止
		if (!file.type.match('image.*')) {
			return;
		}

		$(this).prev().attr('src', '/image/common/gif-load.gif');

		// 画像表示
		var reader = new FileReader();
		var obj = $(this) ;
		reader.onload = function() {

			if (listMode == 0 && imageList.children('li').length < listSize) {

				var idx = 1+obj.parent().parent().data('imageIndex') ;
				imageList.append(
					'<li data-image-index="'+idx+'"><a href="#">'
					+'<img class="cancel" src="/image/common/close_red.gif" />'
					+'<img class="add" src="http://placehold.jp/50x50png?text=＋" />'
					+'<input type="file" name="image-upload['+idx+']" />'
					+'</a></li>'
				) ;
				var child = imageList.children('li:last-child') ;
				child.children().children('img.add').css('width', length+'px') ;
				child.children().children('img.add').css('height', length+'px') ;
			}

			var img_src = obj.prev().attr('src', reader.result);
			var closerLength = obj.prev().outerWidth()/4 ;
			obj.prev().prev().css('display', 'block') ;
			obj.prev().prev().css('width', closerLength+'px') ;
			obj.prev().prev().css('height', closerLength+'px') ;

			// 各リスト要素の設定
			imageList.children('li').each(function(index, elm) {

				// 名前振り直し
				$(elm).data('imageIndex', index) ;
				$(elm).children().children('input').attr('name', 'image-upload['+index+']') ;
				// 指定要素数以上の場合は折り返し
				if (index != 0 && index % colSize == 0) {
					$(elm).addClass('clearfix') ;
				} else {
					$(elm).removeClass('clearfix') ;
				}
			}) ;
		}
		reader.readAsDataURL(file);
	}) ;
}) ;
