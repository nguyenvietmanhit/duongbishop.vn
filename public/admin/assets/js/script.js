function string_to_slug (str) {
    return str
        .toString()                     // Cast to string
        .toLowerCase()                  // Convert the string to lowercase letters
        .normalize('NFD')       // The normalize() method returns the Unicode Normalization Form of a given string.
        .trim()                         // Remove whitespace from both sides of a string
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-');        // Replace multiple - with single -
}

function handleCkeditor() {
    $('textarea').each(function () {
        var textarea_id = $(this).attr('id');
        console.log(textarea_id)
        if (textarea_id == 'name') {
            return;
        }
        CKEDITOR.replace(textarea_id, {
            filebrowserBrowseUrl: url_base + '/admin/assets/ckfinder/ckfinder.html',
            filebrowserUploadUrl: url_base + '{{ url(' / ') }}/admin/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });
    })

    $('.link-remove').click(function () {
        $(this).parent('.element-add-more').remove();
    })
}
$(document).ready(function () {
    $('.name-keyup').keyup(function () {
        $('.report-link').val(string_to_slug($(this).val()));
    })



    $('.link-delete').click(function () {
        var confirm_text = $(this).attr('confirm');
        if (!confirm_text) {
            confirm_text = 'Bạn chắc chắn muốn xóa bản ghi này không, mọi thông tin liên quan đến bản ghi này đều sẽ mất?';
        }
        var is_confirm = confirm(confirm_text);
        if (is_confirm) {
            $(this).parent('form.delete').submit();
        }
        return false;
    })

    // if ($('textarea[name*=content]').length) {
    //     CKEDITOR.replace('content', {
    //         filebrowserBrowseUrl: url_base + '/admin/assets/ckfinder/ckfinder.html',
    //         filebrowserUploadUrl: url_base + '{{ url(' / ') }}/admin/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    //     });
    // }

    var current_url = window.location.href;
    $('.sidebar-menu li').each(function () {
        var href = $(this).find('a').attr('href');
        if (current_url.includes(href)) {
            $(this).addClass('active');
        }
    })

    // $('.add-more').click(function () {
    //     var selector_add_more_first = $(this).parent('.report-common').first().find('.element-add-more');
    //     var count_page = $(this).parent('.report-common').find('.element-add-more').length;
    //     count_page++;
    //     var count_last_page = $('.element-add-more').length;
    //     // count++;
    //     // console.log(count);
    //     var textarea_id = selector_add_more_first.find('textarea').attr('id');
    //     var textarea_name = selector_add_more_first.find('textarea').attr('name');
    //     var value = CKEDITOR.instances[textarea_id].getData();
    //     selector_add_more_first.last().after('<div class="element-add-more">\n' +
    //         '            <label for="content">Trang ' + count_page + '</label><i class="link-remove fa fa-trash" title="Xóa trang này"></i>\n' +
    //         '            <textarea class="form-control" name="' + textarea_name + '" id="' + textarea_id + count_last_page + '">' + value + '</textarea>\n' +
    //         '        </div>');
    //     handleCkeditor();
    //     return false;
    // })

    handleCkeditor();

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('.image-preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $(".image-upload").change(function() {
    readURL(this);
  });

    // setTimeout(function () {
    //     $('.alert').fadeOut(2000);
    // }, 4000);

    $('input[name=name]').keyup(function () {
        var name = $(this).val();
        var seo_keyword = name.replace(/ /g, ",");
        $('input[name=seo_title], input[name=seo_description]').val(name);
        $('input[name=seo_keywords]').val(seo_keyword);
    })
});
