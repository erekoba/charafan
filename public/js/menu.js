$(function () {
	$(".btn-gnavi").on("click", function () {
		// メニューの位置を設定するための変数
		var leftVal = 0;
		// 対象の要素が「open」クラスを持っているか判断して値を返す
		if ($(this).hasClass("open")) {
			// 「open」クラスを持つ要素はメニューを開いた状態
			leftVal = -300;
			// メニューを開いたら次回クリック時は閉じた状態
			// 対象の要素の「open」クラスを削除
			$(this).removeClass("open");
		} else {
			// 「open」クラスを持たない要素はメニューを閉じた状態に設定 (leftVal は0の状態 )
			// 対象の要素に「open」クラスを追加
			$(this).addClass("open");
		}

		$("#global-navi").stop().animate({
			left: leftVal
		}, 200);//アニメーションの速さを設定
	});
});