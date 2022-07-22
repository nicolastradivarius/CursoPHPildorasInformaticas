<?php

class EntradaBlog
{
    private $titulo;
    private $fecha;
    private $comentarios;
    private $imagen;

    public function __construct($titulo, $fecha, $comentarios, $imagen)
    {
        $this->titulo = $titulo;
        $this->fecha = $fecha;
        $this->comentarios = $comentarios;
        $this->imagen = $imagen;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getComentarios(): string
    {
        return $this->comentarios;
    }

    public function getImagen(): string
    {
        return $this->imagen;
    }
}
