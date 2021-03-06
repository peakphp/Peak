#!/usr/bin/env php
<?php

namespace {

    use Core\Cli\Command\CodeGeneratorCommand;
    use Core\Cli\Command\ExampleCommand;
    use Core\Service\ConfigService;
    use Peak\Bedrock\Cli\Application;
    use Peak\Bedrock\Kernel;
    use Peak\Di\Container;

    require 'vendor/autoload.php';

    try {

        $config = (new ConfigService())->create();
        $kernel = new Kernel($config->get('env.ENV', 'prod'), new Container());
        $app = new Application($kernel, $config);

        $app
            ->add(CodeGeneratorCommand::class)
            ->add(ExampleCommand::class)
            ->run();

    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
