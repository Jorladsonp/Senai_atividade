<?php

    require_once __DIR__ . '/src/models/visita.php';
    require_once __DIR__ . '/src/models/contato.php';
    require_once __DIR__ . '/src/models/telefone.php';
    require_once __DIR__ . '/src/models/endereco.php';

    $contato = new Contato();
    $contato->setId(1);
    $contato-> setNome('Merlin de Lança Flamejante');
    $contato->setEmpresa('Estocada');
    $contato->setCargo('Mago de combate');
    $contato->setEmail('merlin_te_sola_de_novo@gmail.com');
    $contato->setAtivo(0);
    $contato->editar();

    $contato->getDados();