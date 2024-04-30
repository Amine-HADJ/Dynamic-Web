<?php
    $port = '5432';
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_DB'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    header('Content-Type: application/json');

    $caracteristique = $_GET['caracteristique'];
    $caracteristique = $caracteristique=="tout" ? "" : $caracteristique;
    $type = $_GET['type'];
    $type = $type="tout" ? "" : $type;

    $sql = "SELECT
                    a.name,
                    c.desc description_symptome,
                    e.mer    meridien_patho,
                    e.type    type_patho,
                    e.desc    desc_patho,
                    f.nom    nom_mer,
                    f.element    element_mer

                FROM
                    keywords a
                    INNER JOIN keySympt b
                        ON a.idK = b.idK
                        INNER JOIN symptome c
                            ON b.idS = c.idS
                            INNER JOIN symptPatho d
                                ON c.idS = d.idS
                                INNER JOIN patho e
                                    ON d.idP = e.idP
                                    INNER JOIN meridien f
                                        ON e.mer = f.code
                WHERE 
                    e.desc LIKE '%$type%$caracteristique%',
            "; 
?>