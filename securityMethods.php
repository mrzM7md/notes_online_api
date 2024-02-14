<?php
    function filterPostRequest($requestName){  // for sql injection !!
        return htmlspecialchars(strip_tags($_POST[$requestName]));
    }

    function filterGetRequest($requestName){  // for sql injection !!
        return htmlspecialchars(strip_tags($_GET[$requestName]));
    }
?>