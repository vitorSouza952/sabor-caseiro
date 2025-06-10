<?php
    if (existeSessao("msg")) :
?>

        <script>
            window.addEventListener("load", function () {
                alternarModalMsg("<?= $_SESSION["msg"] ?>");
            });
        </script>

<?php
        desabilitarSessao("msg");
    endif;
?>