<?php

declare(strict_types=1);

/*
 * This document has been generated with
 * https://mlocati.github.io/php-cs-fixer-configurator/#version:3.1.0|configurator
 * you can change this configuration by importing this file.
 */
$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true) // コードを書き換える破壊的な修正を含むルールを有効にするかを設定します。
    ->setRules([ //追加ルールや除外ルールは
        '@PSR12'                       => true,
        'blank_line_after_opening_tag' => true, // PHPの開始タグの後に一行改行を入れます
        'linebreak_after_opening_tag'  => true, // 開始タグの後ろに改行を入れて開始タグの行には記述がないようにする
        'declare_strict_types'         => true, // 型を厳密に判断する strict モードを強制する
        'binary_operator_spaces'       => [ // = や => などの演算子を揃えるかを設定できます
            'operators' => [
                '='  => 'align',
                '=>' => 'align',
            ]
        ],
        'blank_line_after_namespace'  => true, // ネームスペースの後ろに一行改行を入れます。
        'blank_line_before_statement' => [ // 特定の記述の前に一行改行を入れる
            'statements' => [
                'return',
                'break',
                'continue',
                'declare',
                'return',
                'throw',
                'try'
            ]
        ],
        'elseif'            => true, // 空白のあるelse if の代わりに elseif を使うようにします
        'no_unused_imports' => true, // 使っていないuse宣言を削除します。
        'ordered_imports'   => [ // ステートメントをアルファベット順でソートする
            'sort_algorithm' => 'alpha',
        ],
        'single_trait_insert_per_statement' => false, // trait useで1行1つにしない
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
        ->exclude('vendor')//除外ファイルをここに
        ->in(__DIR__)
    );
