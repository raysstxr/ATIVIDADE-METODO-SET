<?php

class Usuario
{
    private string $nome = '';

  
    private const ARQUIVO = __DIR__ . '/usuarios.json';

    public function __construct(string $nome = '')
    {
        if ($nome !== '') {
            $this->setNome($nome);
        }
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $nome = trim($nome);

        if ($nome === '') {
            throw new InvalidArgumentException('O nome não pode ficar vazio.');
        }

        $this->nome = $nome;
    }

 
    public function salvar(): bool
    {
        $nomes = self::lerNomes();
        $nomes[] = $this->nome;

        $json = json_encode($nomes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        return file_put_contents(self::ARQUIVO, $json, LOCK_EX) !== false;
    }

    
    public static function listarTodos(): array
    {
        $listaUsuarios = [];

        foreach (self::lerNomes() as $nome) {
            $listaUsuarios[] = new Usuario($nome);
        }

        return $listaUsuarios;
    }

    private static function lerNomes(): array
    {
        if (!file_exists(self::ARQUIVO)) {
            return [];
        }

        $dados = json_decode(file_get_contents(self::ARQUIVO), true);

        return is_array($dados) ? $dados : [];
    }
}