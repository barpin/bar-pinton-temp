<?php
include 'assets/ver.php';

$title="Editando articulo";
$headertags=<<<EOF
    
    <script src="/cdn/ckeditor.js" defer></script>
    <script src="/cdn/codemirror.min.js" defer></script>
    <script src="/cdn/show-hint.min.js" defer></script>
    <script src="/cdn/htmlmixed.min.js" defer></script>
    <script src="/cdn/css.min.js" defer></script>
    <script src="/cdn/xml.min.js" defer></script>
    <script src="/cdn/javascript.min.js" defer></script>
    <script src="/cdn/xml-hint.min.js" defer></script>
    <script src="/cdn/html-hint.min.js" defer></script>
    <script src="/cdn/css-hint.min.js" defer></script>
    <script src="/cdn/javascript-hint.min.js" defer></script>
    <script src="/cdn/active-line.min.js" defer></script>
    <script src="/cdn/matchbrackets.min.js" defer></script>
    <link rel="stylesheet" href="/cdn/codemirror.min.css" integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/cdn/show-hint.min.css" integrity="sha512-OmcLQEy8iGiD7PSm85s06dnR7G7C9C0VqahIPAj/KHk5RpOCmnC6R2ob1oK4/uwYhWa9BF1GC6tzxsC8TIx7Jg==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <link href="/css/edit.css?${ver}" rel="stylesheet">
    <script src="/js/lib.js?${ver}"></script>
    <script src="/js/edit.js?${ver}" defer></script>

EOF; //TODO add one of these for dark mode https://codemirror.net/demo/theme.html#icecoder (https://cdnjs.com/libraries/codemirror)

    /*
$headertags=<<<EOF

<script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/codemirror.min.js" integrity="sha512-UczTlJPfdNqI2hb02wot6lMzwUNtjywtRSz+Ut/Q+aR0/D6tLkIxRB+GgjxjX6PSA+0KrQJuwn4z6J+3EExilg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/addon/hint/show-hint.min.js" integrity="sha512-kCn9g92k3GM90eTPGMNwvpCAtLmvyqbpvrdnhm0NMt6UEHYs+DjRO4me8VcwInLWQ9azmamS1U1lbQV627/TBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/codemirror.min.css" integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/addon/hint/show-hint.min.css" integrity="sha512-OmcLQEy8iGiD7PSm85s06dnR7G7C9C0VqahIPAj/KHk5RpOCmnC6R2ob1oK4/uwYhWa9BF1GC6tzxsC8TIx7Jg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/mode/htmlmixed/htmlmixed.min.js" integrity="sha512-IC+qg9ITjo2CLFOTQcO6fBbvisTeJmiT5D5FnXsCptqY8t7/UxWhOorn2X+GHkoD1FNkyfnMJujt5PcB7qutyA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/mode/css/css.min.js" integrity="sha512-2gAMyrBfWPuTJDA2ZNIWVrBBe9eN6/hOjyvewDd0bsk2Zg06sUla/nPPlqQs75MQMvJ+S5AmfKmq9q3+W2qeKw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/mode/xml/xml.min.js" integrity="sha512-UWfBe6aiZInvbBlm91IURVHHTwigTPtM3M4B73a8AykmxhDWq4EC/V2rgUNiLgmd/i0y0KWHolqmVQyJ35JsNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/mode/javascript/javascript.min.js" integrity="sha512-IS1FyxQkiJHT1SAvLXBaJu1UTFSIw0GT/DuzxHl69djqyLoEwGmR2davcZUnB8M7ppi9nfTGZR/vdfqmWt+i6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/addon/hint/xml-hint.min.js" integrity="sha512-WuVO/0caKHKP+D/qCGcesy0yK0jbRq7ymsKS+v4S2yPLfC3UG2afbteLTFpsiJC7X8x0HJ/SOODyjH8gQws2bQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/addon/hint/html-hint.min.js" integrity="sha512-oxBKDzXElkyh3mQC/bKA/se1Stg1Q6fm7jz7PPY2kL01jRHQ64IwjpZVsuZojcaj5g8eKSMY9UJamtB1QR7Dmw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/addon/hint/css-hint.min.js" integrity="sha512-U1bPO4poiFpeOpwVxiNkLdG4QbNPObr0cT8e+vrpf0yodnNHE0qGjQTw16fvQIeXNs9n7lqZO7XlTIkvqKKkLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/addon/hint/javascript-hint.min.js" integrity="sha512-HB0sEfERI4Pe2z7rbx7JVGS0SEEGbnAbV+9X0bs3Hs9R/nCYartwJQg16bK1P0jPsMzbiXjT+kYNHYLCsHQ8HA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
-->    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/addon/selection/active-line.min.js" integrity="sha512-UNVAZmixdjeBtJVQcH5eSKXuVdzbSV6rzfTfNVyYWUIIDCdI9/G8/Z/nWplnSHXXxz9U8TA1BiJ1trK7abL/dg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.1/addon/edit/matchbrackets.min.js" integrity="sha512-RhFcU90dzfpVCAfiAAFCqH/UESr9/ZzrwX9gW1ZjRh9kPu2CTqvWuk85U6ECWis/M9/yZemU+sheJspFobQOag==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<link href="/css/edit.css?${ver}" rel="stylesheet">
<script src="/js/lib.js?${ver}"></script>
<script src="/js/edit.js?${ver}" defer></script>

EOF;
*/


require_once 'assets/database.php';
require_once 'assets/session_start.php';

if (!$loggedin){
    $_SESSION["msg"]="No estas logueado";
    $_SESSION["icon"]="error";
    header('Location: /');
    exit();
}

if (isset($article)){
    $cols=getcols($link);
    $query= $posts_data_query."WHERE textupdates.replaced_at IS NULL AND posts.id = ${article} ";
    $articledata=qq($link, $query)->fetch_assoc();

    if ((gmp_init($_SESSION['perms']) & gmp_init($articledata['p_category'])) == 0 ){
        $_SESSION["msg"]="No Tenes Permiso para editar este articulo";
        $_SESSION["icon"]="error";
        header('Location: /');
    }

    $jsvars = array_merge($articledata, ['isnew'=>0]); 
    $jsvars['t_css']=htmlspecialchars_decode($jsvars['t_css']);
    $jsvars['t_content']=htmlspecialchars_decode($jsvars['t_content']);

    $new=0;
    $query=<<<EOF
    WITH RECURSIVE UsedCategories AS (
        (SELECT * FROM categories WHERE POWER(2, id) & ${articledata['p_category']} = POWER(2, id))
        
        UNION 
        (SELECT categories.* FROM UsedCategories, categories WHERE UsedCategories.parents & POWER(2,categories.parents) = POWER(2,categories.parents))) 
    
    SELECT * FROM UsedCategories;
    EOF; //all this just to avoid doing it in js which ill have to do later anyway.
    $permsdata=entries($link,$query);
} else {
    if (gmp_init($_SESSION['perms'])  == 0 ){
        $_SESSION["msg"]="No Tenes Permiso para crear un articulo";
        $_SESSION["icon"]="error";
        header('Location: /');
    }

    $jsvars = ['isnew'=>1,];
    $new=1;
    $permsdata=entries($link, "SELECT * FROM categories WHERE POWER(2, id) & ${_SESSION['perms']} = POWER(2, id) ");

}
//echo "SELECT * FROM categories WHERE POWER(2, id) & ${_SESSION['perms']} = POWER(2, id) OR id = 0";

//TODO might remove this later, i think this is all done with php directly 
$jsvars=array_merge($jsvars, ['perms'=>$_SESSION['perms'], 'permsdata'=>entries($link, "SELECT * FROM categories", false, 'id')]);
$staticdisabled = gmp_intval((gmp_init($_SESSION['perms']) & 9) == 0);


require_once 'partials/documenthead.php';
include_once 'partials/navbar.php';
require_once 'views/edit.php';
include_once 'partials/footer.php';