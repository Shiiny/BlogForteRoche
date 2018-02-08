

var comment = {

	addComment : function() {
		$('#formComment').hide();
		$('#closeComment').hide();
		$('#addComment').on('click', function() {
			$('#addComment').hide();
			$('#formComment').show();
			$('#closeComment').show();
		});
	},

	closeComment : function() {
		$('#closeComment').on('click', function() {
			$('#closeComment').hide()
			$('#formComment').hide();
			$('#addComment').show();
		});
	},

	tagComment : function() {
		var tag = $('#tag');
		console.log(tag);
		if (tag> 0) {
			tag.addClass('tag_comment');
		}
	}

}

comment.addComment();
comment.closeComment();
comment.tagComment();
