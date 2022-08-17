# WP-Recomend-SQL-Generate

## WP-Recomend-SQL-Generate とは
記事IDが記載されたcsvファイルを読み込み、きらッコノートの個別記事で使われている関連記事欄に指定した記事を登録するSQL文を生成します。

## CSVファイルの書式
ヘッダー行なしのCSVファイルを `csv/import.csv` に配置してください。
1つ目の要素を変更対象記事ID、2つ目以降の要素を関連記事IDとして取得します。

## 実行前の確認
SQL生成前に、 `sql/check.sql` を各環境で実行してキーとして使っている値が重複していないか確認してください。

## 実行方法
`php app/main.php` で実行してください。 `sql/result.sql` にSQL文が出力されます。
