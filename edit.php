<?php
include_once "header.inc.php";

if(!$isAuth){
    header("location: login.php");
    exit();
}

if(empty($_GET["id"]) && empty($_POST["id"])){
    header("location: login.php");
    exit();
}

$post = null;
if(isset($_GET["id"])){
    $post = new Post($_GET["id"]);
}else{
    $post = new Post($_POST["id"]);
}

if($post == null || $post->getId() == 0){
    header("location: index.php");
    exit();
}

$user = unserialize($_SESSION["user"]);
if($post->getAuteur() != $user->getId() && !in_array($user->getId(), $post->getWriteAccessUser())){
    header("location: index.php");
    exit();
}

if(isset($_POST["title"]) && isset($_POST["resume"]) && isset($_POST["content"])){
    $title = $_POST["title"];
    $resume = $_POST["resume"];
    $content = $_POST["content"];
    $theme = isset($_POST["theme"]) ? $_POST["theme"] : "";
    $mc = isset($_POST["mc"]) ? $_POST["mc"] : "";
    $mot_cle = explode(" ", $mc);
    $current = $post->getMotCle();

    foreach ($current as $m){
        if(!in_array($m, $mot_cle)){
            $post->removeMotCle($m);
        }
    }

    foreach ($mot_cle as $m){
        if(!in_array($m, $current)){
            $post->addMotCle($m);
        }
    }

    if(strcmp($title, $post->getTitle()) !== 0){
        $post->setTitle($title);
    }

    if(strcmp($resume, $post->getResume()) !== 0){
        $post->setResume($resume);
    }

    if(strcmp($content, $post->getContent()) !== 0){
        $post->setContent($content);
    }

    if(strcmp($theme, $post->getTheme()) !== 0){
        $post->setTheme($theme);
    }

    $id = $post->getId();
    header("location: post.php?id=$id");
    exit();
}

?>


<form method="post" action="edit.php">
    <br/>
    <input type="hidden" name="id" value="<?php echo $post->getId(); ?>" />
    <input type="text" class="form-control" placeholder="Titre" name="title" value="<?php echo $post->getTitle(); ?>"><br/>
    <input type="text" class="form-control" placeholder="Theme" name="theme" value="<?php echo $post->getTheme(); ?>"><br/>
    <input type="text" class="form-control" placeholder="Mots clés" name="mc" value="<?php echo $post->getTitle(); ?>"><br/>
    <textarea name="resume" class="form-control" placeholder="Resume"><?php echo $post->getResume(); ?></textarea><br/>
    <textarea id="editor" name="content"><?php echo $post->getContent(); ?></textarea><br/>
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