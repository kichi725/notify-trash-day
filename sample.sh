#!/bin/bash

# ステージングされたphpファイルのみ抽出
FILE=`git diff --staged --name-only --diff-filter=AM | grep -E '*.php$'`
# php-cs-fixerによる自動整形
# echo `vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php --path-mode=intersection $FILE`
# echo `vendor/bin/php-cs-fixer fix`
FIXED=`./vendor/bin/sail exec -T web ./vendor/bin/php-cs-fixer fix`

echo "$FIXED"

# 整形されたファイルがあった場合、addする
if [[ $FIXED =~ '1)' ]]
then
    echo 'ファイルが自動整形されました。コミットを中断します。自動整形されたファイルを確認してください。'
    git add .
    exit 1
else
    echo 'Nothing fixed file. Commited!'
fi
