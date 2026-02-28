<?php

    require_once __DIR__ . '/src/models/visita.php';
    require_once __DIR__ . '/src/models/contato.php';
    require_once __DIR__ . '/src/models/telefone.php';
    require_once __DIR__ . '/src/models/endereco.php';

    $contato = new Contato();
    $contato-> setNome('Merlin de Espada');
    $contato->setEmpresa('Alquimistas');
    $contato->setCargo('Mago supremo');
    $contato->setEmail('merlin_te_sola@gmail.com');
    //$contato->inserir();

    $contato->getDados();