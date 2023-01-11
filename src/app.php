<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/db-connect.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Request;

// Setup the application
$app = new Application();
$app->register(new TwigServiceProvider, array(
    'twig.path' => __DIR__ . '/templates',
));

// Setup the database
$app['db.table'] = DB_TABLE;
$app['db.dsn'] = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST;
$app['db'] = $app->share(function ($app) {
    return new PDO($app['db.dsn'], DB_USER, DB_PASSWORD);
});

// Handle the index page
$app->match('/', function () use ($app) {
    $query = $app['db']->prepare("SELECT message, author FROM {$app['db.table']}");
    $thoughts = $query->execute() ? $query->fetchAll(PDO::FETCH_ASSOC) : array();

    return $app['twig']->render('index.twig', array(
        'title'    => 'Your Thoughts',
        'thoughts' => $thoughts,
    ));
});


#######
$conn = new mysqli('terraform-20230108221845171900000001.csfl3dafisa1.eu-central-1.rds.amazonaws.com', 'admin', 'ohayPgeefVYbWnovSHu99iVQ', 'mydb');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT author, message FROM urler";
$result = $conn->query($sql);
print_r($result);
#######

// Handle the add page
$app->match('/add', function (Request $request) use ($app) {
    $alert = null;
    // If the form was submitted, process the input
    if ('POST' == $request->getMethod()) {
        try {
            // Make sure the photo was uploaded without error
            $message = $request->request->get('thoughtMessage');
            $author = $request->request->get('thoughtAuthor');
            if ($message && $author && strlen($author) < 64) {
                // Save the thought record to the database
                $sql = "INSERT INTO {$app['db.table']} (message, author) VALUES (:message, :author)";
                $query = $app['db']->prepare($sql);
                $data = array(
                    ':message' => $message,
                    ':author'  => $author,
                );
                if (!$query->execute($data)) {
                    throw new \RuntimeException('Saving your thought to the database failed.');
                }
            } else {
                throw new \InvalidArgumentException('Sorry, The format of your thought was not valid.');
            }

            // Display a success message
            $alert = array('type' => 'success', 'message' => 'Thank you for sharing your thought.');
        } catch (Exception $e) {
            // Display an error message
            $alert = array('type' => 'error', 'message' => $e->getMessage());
        }
    }

    return $app['twig']->render('add.twig', array(
        'title' => 'Share Your Thought!',
        'alert' => $alert,
    ));
});

$app->run();
