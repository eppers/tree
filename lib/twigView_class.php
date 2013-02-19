<?php

class twigView extends Slim_View {
    public function render( $template) {
        $loader = new Twig_Loader_Filesystem($this->getTemplatesDirectory());
        $twig = new Twig_Environment($loader);
        $twig->addGlobal("session", $_SESSION);
                return $twig->render($template, $this->data);
    }
}

?>
