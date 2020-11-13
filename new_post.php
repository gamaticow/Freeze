<?php
include_once "header.inc.php";

if(!$isAuth){
    header("location: login.php");
    exit();
}

if(isset($_POST["title"]) && isset($_POST["resume"]) && isset($_POST["content"])){
    $user = unserialize($_SESSION["user"]);

    $title = $_POST["title"];
    $resume = $_POST["resume"];
    $content = $_POST["content"];
    $theme = isset($_POST["theme"]) ? $_POST["theme"] : "";
    $mc = isset($_POST["mc"]) ? $_POST["mc"] : "";
    $mot_cle = explode(" ", $mc);

    $post = $user->createPost($title, $resume, $content, $mot_cle, $theme);
    $id = $post->getId();

    header("location: post.php?id=$id");
    exit();
}

?>


            <form method="post" action="new_post.php">
                <br/>
                <input type="text" class="form-control" placeholder="Titre" name="title"><br/>
                <input type="text" class="form-control" placeholder="Theme" name="theme"><br/>
                <input type="text" class="form-control" placeholder="Mots clés" name="mc"><br/>
                <textarea name="resume" class="form-control" placeholder="Resume"></textarea><br/>
                <textarea id="editor" name="content"></textarea><br/>
                <input type="submit" class="btn btn-primary" value="Poster">
            </form>

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

<?php
include_once "footer.inc.php";