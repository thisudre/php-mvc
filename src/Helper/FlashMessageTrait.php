<?php

namespace Alura\Cursos\Helper;

Trait FlashMessageTrait 
{
    
    public function enviaMensagem($mensagem, $tipoMensagem)
    {
        $_SESSION['mensagem'] = $mensagem;
        $_SESSION['tipo_mensagem'] = $tipoMensagem;
    }
}