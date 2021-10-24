<?php
// ecs.php
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PARALLEL, true);
    $parameters->set(Option::CACHE_DIRECTORY, __DIR__ . '/.cache/ecs_cache');
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // Full sets
    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::DOCBLOCK);

    // Standalone rules:
    $services = $containerConfigurator->services();
    $services->set(ArraySyntaxFixer::class)
        ->call('configure', [[
            'syntax' => 'short',
        ]]);
};
