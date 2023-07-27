<?php declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
  ->in(__DIR__ . DIRECTORY_SEPARATOR . 'src');

return (new PhpCsFixer\Config())
  ->setIndent('  ')
  ->setRules([
               'braces' => true,
               'declare_strict_types' => true,
               'encoding' => true,
               'no_unused_imports' => true,
               'ordered_imports' => ['sort_algorithm' => 'alpha', 'imports_order' => ['class', 'const', 'function']],
               'phpdoc_summary' => true,
               'single_blank_line_at_eof' => true,
               'single_quote' => true,
               'global_namespace_import' => [
                 'import_classes' => true,
                 'import_constants' => true,
                 'import_functions' => true,
               ],
               'visibility_required' => true,
             ])
  ->setFinder($finder);
