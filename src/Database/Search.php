<?php
    $port = '5432';
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_DB'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    header('Content-Type: application/json');

    $query = $_GET['query'];

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    } catch (PDOException $e) {
        echo $e->getCode() . ' ' . $e->getMessage();
    }

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
            WHERE a.name LIKE '%$query%'
        "; 
    $sth = $conn->prepare( $sql ); 
    $sth->execute();
    $elements = $sth->fetchAll();

    echo json_encode($elements);
?>