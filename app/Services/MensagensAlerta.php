<?php

class MensagensAlerta 
{

    //ERRO
    public static function erroCadastro()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'erro', 'msg' => 'Ocorreu um erro ao tentar efetuar o cadastro!'];
    }

    public static function erroUpload()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'erro', 'msg' => 'Ocorreu um erro ao tentar efetuar o upload!'];
    }

    public static function erroExtensaoIMG()
    {
        session_start();
        $_SESSION['alerta'] =  ['type' => 'erro', 'msg' => 'O sistema só aceita imagens com a extensão PNG!'];
    }

    public static function erroExtensaoPDF()
    {
        session_start();
        $_SESSION['alerta'] =  ['type' => 'erro', 'msg' => 'O sistema só aceita arquivos com a extensão PDF!'];
    }

    public static function erroArquivoJaExiste()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'erro', 'msg' => 'Já existe um arquivo para este sorteio!'];
    }

    
    public static function erroExcedeuLimitBytes()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'erro', 'msg' => 'O arquivo excedeu o limite de tamanho. O tamanho máximo permidito é 10 MB'];
    }
    public static function erroUpdate()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'erro', 'msg' => 'Ocorreu um erro ao tentar editar!'];
    }

    public static function erroLoginIncorreto()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'erro', 'msg' => 'Login ou senha incorretos!'];
    }

    //SUCESSO
    public static function sucessoCadastroSorteio()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'sucesso', 'msg' => 'Sorteio cadastrado com <strong>sucesso!</strong>'];
    }
    public static function sucessoUpdateSorteio()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'sucesso', 'msg' => 'Sorteio atualizado com <strong>sucesso!</strong>'];
    }
    public static function sucessoUploadImg()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'sucesso', 'msg' => 'Upload da imagem feito com <strong>sucesso!</strong>'];
    }

    public static function sucessoUploadArquivo()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'sucesso', 'msg' => 'Upload do arquivo feito com <strong>sucesso!</strong>'];
    }
    public static function sucessoArquivoAtualizado()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'sucesso', 'msg' => 'O arquivo foi atualizado com <strong>sucesso!</strong>'];
    }
    public static function sucessoArquivoBackgroundAtualizado()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'sucesso', 'msg' => 'O background foi atualizado com <strong>sucesso!</strong>'];
    }

    public static function sucessoCadastroCodigoSorteio()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'sucesso', 'msg' => 'Código sorteio cadastrado com <strong>sucesso!</strong>'];
    }
    public static function sucessoUpdateCodigoSorteio()
    {
        session_start();
        $_SESSION['alerta'] = ['type' => 'sucesso', 'msg' => 'Código Sorteio atualizado com <strong>sucesso!</strong>']; 
    }
}