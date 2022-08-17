--'_article_recommend'が一通りであることを確認
select
    count(*),
    meta_value
from
    wp_postmeta
where
    meta_key = '_article_recommend'
group by
    meta_value;

-- meta_keyが'_article_recommend'の場合、post_idを指定すれば記事を特定できるか、事実上の複合ユニークとして使えるか確認
select
    count(*) as count,
    post_id
from
    wp_postmeta
where
    meta_key = '_article_recommend'
group by
    post_id
order by count desc;


--'_article_recommend'がmeta_keyと post_idで特定できるか、事実上の複合ユニークとして使えるか確認
select
    count(*) as count,
    post_id
from
    wp_postmeta
where
    meta_key = 'article_recommend'
group by
    post_id
order by count desc;
