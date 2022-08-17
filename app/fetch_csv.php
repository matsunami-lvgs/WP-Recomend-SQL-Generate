<?php

class FetchCsv
{
    const FILE_PATH = '../csv/import.csv';
    /**
     * csvの1つ目の要素を追加する記事ID、2つ目以降の要素を関連記事IDとして、
     * 追加する記事IDをキー、関連記事IDを値としてもつ連想配列として返す
     * @return arr
     */
    public function main()
    {
        $file = new SplFileObject(self::FILE_PATH);
        $csv_arr = [];
        for ($i = 1; !$file->eof(); $i++) {
            $row = $file->fgetcsv();
            $post_id = $row[0];
            foreach ($row as $key => $value) {
                if (empty($value) || $post_id == $value) {
                    unset($row[$key]);
                }
            }
            $recomend_posts = array_values($row);

            if ($post_id && $recomend_posts) {
                $csv_arr[$post_id] = $recomend_posts;
            }
        }
        return $csv_arr;
    }
}
