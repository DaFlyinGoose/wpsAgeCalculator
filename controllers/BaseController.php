<?php 
namespace Controllers;

use Illuminate\Database\Capsule\Manager as Capsule;
use Exception;

/**
 * Class BaseController
 * We will add any shared functions here and also handle booting Eloquent
 */
class BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = $this->setupDB();
    }

    /**
     * Include a view with access to the passed variables or throw an exception
     * highlighting the view wasn't found
     *
     * @param $path
     * @param array $variables
     * @throws Exception
     */
    protected function view($path, $variables = [])
    {
        $path = __DIR__ . '/../views/site/' . $path;
        if (file_exists($path)) {
            // Create all the required variables
            foreach ($variables as $key => $value) {
                $$key = $value;
            }

            include $path;
        } else {
            throw new Exception('Could not find view to display');
        }
    }

    /**
     * Boot eloquent for use in controllers
     *
     * @return Capsule
     */
    private function setupDB()
    {
        // Create Capsule, used to boot Eloquent without the rest of Laravel framework
        $capsule = new Capsule;

        $capsule->addConnection($this->dbConfig());

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();

        return $capsule;
    }

    /**
     * Fetch the database connection details
     *
     * @return mixed
     */
    private function dbConfig()
    {
        return include __DIR__ . '/../config/database.php';
    }
}