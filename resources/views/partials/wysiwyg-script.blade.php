<!-- WYSIWYG -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        // Warning: the selector must match with the id attribute
        selector: 'textarea.wysiwyg',
        height: 300,
        plugins: [
            'advlist autolink lists link charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code',
            'textcolor'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | fontsizeselect fontselect',
        content_css: '//www.tinymce.com/css/codepen.min.css',
        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,
    });
</script>
<link rel="stylesheet" type="text/css" href="http://cdn.tinymce.com/4/skins/lightgray/skin.min.css">
