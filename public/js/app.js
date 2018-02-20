var App = {

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
	},

	previewInput : function() {
		var input = document.querySelector('input[type=file]');
		var preview = document.querySelector('.preview');

		if (input != null) {
			input.addEventListener('change', updateImageDisplay);
		}

		function updateImageDisplay() {
		  
			var curFiles = input.files;
			console.log(curFiles);
			if(curFiles.length > 0) {
				for(var i = 0; i < curFiles.length; i++) {
					var listItem = document.createElement('li');
					var para = document.createElement('p');
		      
					para.textContent = curFiles[i].name + ', file size ' + returnFileSize(curFiles[i].size) + '.';
					var image = document.createElement('img');
					image.src = window.URL.createObjectURL(curFiles[i]);

					preview.appendChild(image);
					preview.appendChild(para);
				}
			}
		}

		function returnFileSize(number) {
		  if(number < 1024) {
		    return number + ' octets';
		  } else if(number > 1024 && number < 1048576) {
		    return (number/1024).toFixed(1) + ' Ko';
		  } else if(number > 1048576) {
		    return (number/1048576).toFixed(1) + ' Mo';
		  }
		}
	},

	burgerMenu : function() {
		$('.burger').on('click', function () {
		    $(this).toggleClass('open');
		});

		$('.burger').on('touch', function () {
		    $(this).toggleClass('open');
		});
	}

}

App.addComment();
App.closeComment();
App.tagComment();
App.previewInput();
App.burgerMenu();

