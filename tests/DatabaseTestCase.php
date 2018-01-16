<?php

use Phinx\Config\Config;
use Phinx\Migration\Manager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;
use App\Framework\DependencyInjection\Container;
use Symfony\Component\Yaml\Yaml;

class DatabaseTestCase extends TestCase
{
    protected $app;

    public function setUp ()
    {
        $this->app = $this->getApplication();
        $configArray = Yaml::parseFile(__DIR__.'/../phinx.yml');
        $configArray['environments']['testing'] = [
            'adapter'    => 'sqlite',
            'connection' => $this->app['db']
        ];
        $config = new Config($configArray);
        $manager = new Manager($config, new StringInput(' '), new NullOutput());
        $manager->migrate('testing');
//        $manager->seed('testing');
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->app['db']->exec("DROP TABLE concerts");
    }


    public function getApplication()
    {
        return require __DIR__.'/../src/Framework/bootstrap.php';
    }
}