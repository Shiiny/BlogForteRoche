

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
	}

}

comment.addComment();
comment.closeComment();
