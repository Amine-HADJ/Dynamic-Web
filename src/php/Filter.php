<?php
    require_once './Database.php';

    $db = new Database();

    header('Content-Type: application/json');

    $caracteristique = $_GET['caracteristique'];
    $caracteristique = $caracteristique == "tout" ? "" : $caracteristique;
    $type = $_GET['type'];
    $type = $type == "tout" ? "" : $type;

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
                    e.desc LIKE '%$type%$caracteristique%'
            "; 
    $sth = $db->conn->prepare( $sql ); 
    $sth->execute();
    $elements = $sth->fetchAll();

    echo json_encode($elements);
?>