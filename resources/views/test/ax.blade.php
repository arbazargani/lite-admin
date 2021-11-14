<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>axios test</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
    <label for="amount">Insert the value</label>
    <input type="text" name="amount" id="amount" onchange="HandleThat()">
    <span id="response"></span>
    @include('test.script')

    <?php

    // Create DOM from URL or file
    $content = file_get_contents('https://torob.com/p/0599baeb-2de2-4b48-bce5-a5bea3fd612a/xfx-rx-580p8dbdr-radeon-rx580-gts-black-edition-8gb-oc%2B-graphics-card/');
    /*** a new dom object ***/
    $dom = new domDocument;

    /*** load the html into the object ***/
    libxml_use_internal_errors(true);
    $dom->loadHTML($content);
    libxml_clear_errors();

    /*** discard white space ***/
    $dom->preserveWhiteSpace = false;

    /*** the table by its tag name ***/
    $nodes = $dom->getElementById('0')->getElementsByTagName('div')[12]->nodeValue;
    echo "<pre>";
    var_dump($nodes);
    ?>
</body>
</html>
