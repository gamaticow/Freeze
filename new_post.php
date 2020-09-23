<?php
include_once "header.inc.php";
/*
if(!$isAuth){
    header("location: login.php");
    exit();
}*/


?>
<div class="container">
    <div class="row">
        <div class="col-md-24">
            <div id="editor"></div>
        </div>
    </div>
</div>

<button class="btn btn-primary"
        type="button">
    Publier
</button>

<script src="assets/js/Ckeditor/ckeditor.js"></script>
<script>ClassicEditor
        .create( document.querySelector( '#editor' ), {

            toolbar: {
                items: [
                    'heading',
                    'undo',
                    'redo',
                    '|',
                    'bold',
                    'underline',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'alignment',
                    'indent',
                    'outdent',
                    '|',
                    'fontSize',
                    'fontFamily',
                    'fontColor',
                    'fontBackgroundColor',
                    'highlight',
                    '|',
                    'specialCharacters',
                    'blockQuote',
                    'insertTable',
                    '|'
                ]
            },
            language: 'fr',
            image: {
                toolbar: [
                    'imageTextAlternative',
                    'imageStyle:full',
                    'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },
            licenseKey: '',

        } )
        .then( editor => {
            window.editor = editor;








        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: d5ne6p3b3qcm-ew5n8yqgjvtt' );
            console.error( error );
        } );
</script>
