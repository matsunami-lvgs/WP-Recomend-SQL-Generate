<?php
require('./fetch_csv.php');
require('./parse.php');

class MakeSql
{
    public function main()
    {
        //ヒアドキュメント内で定数を展開できないため定数の代わりを変数で定義
        $table = 'wp_postmeta';
        $column = 'meta_value, post_id, meta_key';
        $article_recomended = 'article_recommend';
        $under_article_recomended = '_article_recommend';
        //各環境でチェック
        $under_article_recomended_meta_value = 'field_606464c813bc6';

        $paece = new Parse;
        $fetch_csv = new FetchCsv;
        //CSVから生成した配列キーを埋め込み記事ID, 値をレコメンド表示記事IDとする
        $csv = $fetch_csv->main();

        $sql = "BEGIN;\n";
        foreach ($csv as $post_id => $recomend_posts) {
            $parced = $paece->parse_array($recomend_posts);
            $delete_and_insert = <<<EOM
            DELETE FROM 
                $table
            WHERE
                meta_key = '$article_recomended'
                AND post_id = '$post_id';

            DELETE FROM 
                $table
            WHERE
                meta_key = '$under_article_recomended'
                AND post_id = '$post_id';

            INSERT INTO
                $table ($column)
            VALUES 
                (
                    '$parced',
                    '$post_id',
                    '$article_recomended'
                );

            INSERT INTO
                $table ($column)
            VALUES
                (
                    '$under_article_recomended_meta_value',
                    '$post_id',
                    '$under_article_recomended'
                );\n\n
            EOM;
            $sql .= $delete_and_insert;
        }
        $sql .= "COMMIT;\n";
        return $sql;
    }
}
