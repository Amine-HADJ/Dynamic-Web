<?php
    $port = '5432';
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_DB'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];

    $json = file_get_contents('php://input');
    $data_array = json_decode($json, true);

    $query = "CREATE TABLE IF NOT EXISTS products (
        id SERIAL PRIMARY KEY,
        image VARCHAR(255) NOT NULL,
        title VARCHAR(255) NOT NULL,
        price VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        link VARCHAR(255) NOT NULL
    );";

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    } catch (PDOException $e) {
        echo $e->getCode() . ' ' . $e->getMessage();
    }

    $conn->query($query);

    $insert_query = "INSERT INTO products (image, title, price, description, link) VALUES (:image, :title, :price, :description, :link)";
    $sth = $conn->prepare($insert_query);

    foreach ($data_array as $item) {
        $stmt->bindValue(':image', $item->image);
        $stmt->bindValue(':title', $item->title);
        $stmt->bindValue(':price', $item->price);
        $stmt->bindValue(':description', $item->desc);
        $stmt->bindValue(':link', $item->link);
        $stmt->execute();
    }
  
    echo 'ok';

    $conn = null;
?>
