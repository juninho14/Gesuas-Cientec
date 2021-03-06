<?php
    /*
     Controller da Pesquisa
    */

    class BuscaController
    {
        public $nis;
        public $emoji;
        public $resultado;
        public $titulo;
        public $descricao;
        public $svg;
        public $usuario;
        public $sucesso;
        
        function __construct()
        {
            require_once 'Model/UsuarioModel.php'; 
        }
		//instancio o controller da página
        public function principal($data)
        {
            $bd             = new usuarioModel();
            //por questao de segurança é permitido o usuário buscar nis com caracteres diferentes de 11.
            $this->nis          = addslashes($_GET['nis']);
            $dadosBD            = $bd->buscaUsuario($this->nis);
            $this->titulo       = 'Resultado da Busca por ' . $this->nis; //para SEO (metatag) e para o título da própria pagina
            $this->descricao    = 'Resultado da busca por ' . $this->nis . ' para encontrar usuário caixa pelo número de NIS.'; //description meta tag - para SEO;

            if (count($dadosBD)>0){
                $this->resultado    = "NIS localizado!";
                $this->emoji        = '😉';
             
                $this->svg          = '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" xml:space="preserve" viewBox="0 0 181.167 181.167"><path d="M148.556 0H32.613c-9.994 0-18.121 8.126-18.121 18.115v144.94c0 9.986 8.126 18.111 18.121 18.111h115.943c9.992 0 18.118-8.125 18.118-18.111V18.121C166.679 8.131 158.554 0 148.556 0zm10.875 163.055c0 5.996-4.878 10.871-10.875 10.871H32.613c-5.995 0-10.87-4.875-10.87-10.871V18.121c0-5.995 4.875-10.87 10.87-10.87h115.943c5.992 0 10.867 4.875 10.867 10.87v144.935h.008z"/><path d="M128.792 79.212H52.384a3.325 3.325 0 00-3.324 3.33 3.326 3.326 0 003.324 3.33h76.407a3.325 3.325 0 003.326-3.33 3.325 3.325 0 00-3.325-3.33zM128.792 94.386H52.384c-1.839 0-3.324 1.494-3.324 3.333s1.485 3.326 3.324 3.326h76.407a3.322 3.322 0 003.326-3.326 3.324 3.324 0 00-3.325-3.333zM128.792 109.555H52.384a3.327 3.327 0 00-3.324 3.331 3.323 3.323 0 003.324 3.328h76.407a3.324 3.324 0 003.326-3.328 3.327 3.327 0 00-3.325-3.331zM128.792 124.728H90.585c-1.836 0-3.328 1.488-3.328 3.327s1.492 3.333 3.328 3.333h38.206c1.841 0 3.321-1.494 3.321-3.333s-1.48-3.327-3.32-3.327zM128.792 154.693h-26.747a3.321 3.321 0 00-3.326 3.328 3.32 3.32 0 003.326 3.326h26.747a3.32 3.32 0 003.321-3.326 3.32 3.32 0 00-3.321-3.328zM94.296 64.583c0-6.298-7.251-14.793-17.039-17.275 4.089-2.75 6.907-8.181 6.907-13.072 0-6.898-5.586-12.496-12.49-12.496-6.896 0-12.49 5.598-12.49 12.496 0 4.886 2.818 10.317 6.898 13.072-9.774 2.481-17.03 10.982-17.03 17.275.008 7.442 45.244 7.442 45.244 0zm-23.629-13.65h-.057l-2.068-2.375c1.011.358 2.042.577 3.133.577 1.093 0 2.125-.213 3.134-.572l-2.074 2.369h-.049l5.337 12.895-6.348 6.332-6.341-6.332 5.333-12.894z"/></svg>';
                $this->sucesso      = true;
            } else {
                $this->resultado = "Cidadão não encontrado.<br> Sua busca pelo NIS <strong>" . $this->nis . "</strong> não retornou nenhum usuário.";
                $this->emoji     = '🙄';
                $this->sucesso   = false;
            }
 
            require_once  $data['home_url'] . 'View/busca.php';
			
        }

        

    }