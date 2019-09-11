
$(document).ready(function() {
  //прикрепляем клик по заголовкам acc-head
	$('.accordeon .acc-head').on('click', f_acc);
});
 
function f_acc(){
//скрываем все кроме того, что должны открыть

  $('.accordeon .acc-body').not($(this).next()).slideUp(500);
// открываем или скрываем блок под заголовком, по которому кликнули
 $(this).next().slideToggle(500);
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_upload_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".inputFile").change(function () {
    readURL(this);
});

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                // Render thumbnail.
                var span = document.createElement('span');
                span.innerHTML = ['<div class="vg-dotted-square vg-center"><img class="vg_delete" src="', e.target.result,
                    '" title="', escape(theFile.name), '"/></div>'].join('');
                document.getElementById('list').insertBefore(span, null);
            };
        })(f);

        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
}

document.getElementById('files').addEventListener('change', handleFileSelect, false);


$('.success').delay(2000).hide(0);